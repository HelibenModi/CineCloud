<?php
class Api {
    private $omdbKey;
    private $geminiKey;
    private $youtubeKey;
    private $tastediveKey;

    public function __construct() {
        $this->omdbKey = $_ENV['OMDB_API_KEY'] ?? 'null';
        $this->geminiKey = $_ENV['GEMINI'] ?? '';
        $this->youtubeKey = $_ENV['YOUTUBE_API_KEY'] ?? 'AIzaSyCI4yp1KJe1s7KvOmftr4j3D-3cvr2-730';
        $this->tastediveKey = $_ENV['TASTEDIVE_KEY'] ?? '1063044CnieclouC634A5DB';
    }

    // Fetch movie info from OMDB
    public function searchMovie($title) {
        $title = urlencode($title);
        $url = "http://www.omdbapi.com/?apikey={$this->omdbKey}&t=$title";
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    // Generate AI review using Gemini API
    public function generateReview($title) {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $this->geminiKey;

        $prompt = "Write a short AI review for the movie titled '{$title}'.";

        $data = [
            "contents" => [
                [
                    "role" => "user",
                    "parts" => [
                        ["text" => $prompt]
                    ]
                ]
            ]
        ];

        $json_data = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return 'CURL Error: ' . curl_error($ch);
        }

        curl_close($ch);

        $responseData = json_decode($response, true);
        return $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'AI review not available.';
    }

    // Fetch YouTube trailer
    public function fetchTrailer($movieTitle) {
        $query = urlencode($movieTitle . ' official trailer');
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=1&q={$query}&key={$this->youtubeKey}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (!empty($data['items'][0]['id']['videoId'])) {
            return "https://www.youtube.com/embed/" . $data['items'][0]['id']['videoId'];
        }

        return null;
    }

    // Fetch similar movies using TasteDive
    public function fetchSimilarMovies($movieTitle) {
        $query = urlencode($movieTitle);
        $url = "https://tastedive.com/api/similar?q={$query}&type=movies&info=1&k={$this->tastediveKey}";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['Similar']['Results'])) {
            return $data['Similar']['Results']; 
        }

        return []; 
    }
}
?>
