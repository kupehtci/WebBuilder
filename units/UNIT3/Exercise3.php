<html>
<head>
	<title>Exercise3</title>
</head>
<body>
    <?php
        function createHtmlTable($data) {
            echo "<style>
            .exercise-table {
                border-collapse: collapse;
                width: 100%;
                border: 1px solid black;
            }
            </style>"; 
            
            $htmlTable = ""; 
            $htmlTable .= "<table class='exercise-table'>";
        
            foreach ($data as $row) {
                $htmlTable .= "  <tr>";
                foreach ($row as $value) {
                    $cell = htmlspecialchars($value);
                    $htmlTable .= "    <td>{$value}</td>";
                }
                $htmlTable .= "  </tr>";
            }
        
            // Close the table tag
            $htmlTable .= "</table>";
        
            return $htmlTable;
        }
        
        // Example usage:
        $data = [
            ["Header 1", "Header 2", "Header 3"],
            [1, 2, 3],
            [4, 5, 6],
            ["Hello", "World", "!"]
        ];
        
        $htmlResult = createHtmlTable($data);
        echo $htmlResult;
    ?>
</body>
</html>