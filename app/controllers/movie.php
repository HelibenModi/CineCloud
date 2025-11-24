<?php
class Movie extends Controller {

    public function index() {
        $title = $_GET['title'] ?? '';

        if (!empty($title)) {
            // Internally forward to search() method if a title is present.
            $this->search($title);
        } else {
            // If no title provided, load the search form view.
            $this->view('movie/search');
        }
    }

    public function search($title = null) {
        $title = $title ?? ($_GET['title'] ?? '');

        if (empty($title)) {
            $this->view('movie/search', ['error' => 'Please enter a movie title.']);
            return;
        }

        $api = $this->model('Api');
        $movie = $api->searchMovie($title);

        if (!$movie || $movie['Response'] === 'False') {
            $this->view('movie/results', [
                'movie' => null,
                'review' => null,
                'title' => $title,
                'cast' => '',
                'error' => 'Movie not found. Please try another title.'
            ]);
            return;
        }

        $review = $api->generateReview($movie['Title']);
        $trailerUrl = $api->fetchTrailer($movie['Title']); // fetch the trailer
        $similarMovies = $api->fetchSimilarMovies($movie['Title']); // fetch similar movies

        // Pass everything in **one single view call**
        $this->view('movie/results', [
            'movie' => $movie,
            'review' => $review,
            'title' => $movie["Title"],
            'cast' => $movie['Cast'] ?? '',
            'trailer' => $trailerUrl,
            'similar' => $similarMovies
        ]);
    }

    public function fetchTrailer($movieTitle) {
        $query = urlencode($movieTitle . ' official trailer');
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=1&q={$query}&key={$this->youtubeKey}";

        $response = @file_get_contents($url);
        if (!$response) {
            error_log("YouTube API failed: " . $url);
            return null;
        }

        $data = json_decode($response, true);
        error_log(print_r($data, true)); // <-- this will log API response

        if (!empty($data['items'][0]['id']['videoId'])) {
            return "https://www.youtube.com/embed/" . $data['items'][0]['id']['videoId'];
        }

        return null;
    }


    public function rate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieTitle = $_POST['movie_title'] ?? '';
            $rating = (int) ($_POST['rating'] ?? 0);

            if (empty($movieTitle) || $rating < 1 || $rating > 5) {
                // Invalid rating submission
                header("Location: /movie/search");
                exit;
            }

            // Simple DB Example (PDO assumed)
            $db = new PDO(DB_DSN, DB_USER, DB_PASS);
            $stmt = $db->prepare("INSERT INTO ratings (movie_title, rating, created_at) VALUES (?, ?, NOW())");
            $stmt->execute([$movieTitle, $rating]);

            // With this:
            header("Location: /movie/search?title=" . urlencode($movieTitle) . "&success=1");
            exit;
        } else {
            // Invalid access method
            header("Location: /movie/index");
            exit;
        }
    }

}
?>
