<html>
<head>
	<title>Exercise2</title>
</head>
<body>
    <?php
        echo "<h2>2. Can you create a function to create lists in HTML? It should receive an array with the
        elements of the list, and an optional parameter to specify the type of list (ordered,
        unordered, description). It will return the string with the resulting HTML. It shouldn’t
        modify the arrays.</h2>"; 

        enum ListType{
            case unordered; 
            case ordered; 
            case description; 
        }

        function CreateList($array, $listType){
            $output = ""; 

            switch($listType){
                case ListType::unordered:
                    $output .= "<ul>";
                    foreach($array as $item){
                
                        $output .= "<li>$item</li>"; 
                    }
                    $output .= "</ul>"; 
                    break; 
                case ListType::ordered:
                    $output .= "<ol>";
                    foreach($array as $item){
                
                        $output .= "<li>$item</li>"; 
                    }
                    $output .= "</ol>";
                    break; 
                case ListType::description: 
                    $output .= "<dl>";
                    foreach($array as $item){
                
                        $output .= "<dt>$item</dt>"; 
                        $output .= "<dd>Description of $item</dd>"; 
                    }
                    $output .= "</dl>";
                    break; 
                default: 
                    $output .= "Not a valid list type";
                    break; 

            }
            
            return "$output"; 
        }

        $array = array("Hello", "World", "How", "Are", "You");

        $output_list = CreateList($array, ListType::description); 

        echo "$output_list"; 
    ?>
</body>
</html>