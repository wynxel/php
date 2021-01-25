<?php 
/*
TODO:
    - html template
*/

# CONSTANTS:
$TABLE_NAME = 'Books';
# TABLE COLUMNS:
$COL_ID = 'id';
$COL_NAME = 'book_name';
$COL_AUTH = 'book_author';
$COL_PUBL = 'book_publisher';
$COL_YEAR = 'book_year';
$COL_PICT = 'picture_url';
$COL_RATE = 'rating';
$COL_DESC = 'description';
# GET ARRAY:
$_GET_ID = 'id';

# CONNECT TO DATABASE:
$sqlcon = new mysqli('localhost', 'user', 'qQ1wW2eE3!', 'php');

# HANDLE DB CONNECION ERROR:
if ($sqlcon -> connect_error) {
    echo "Something went wrong with database connection.<br>";
    #echo "Error: " . mysqli_connect_error() . "<br>";
    exit;
}

# IF BOOK ID IN GET ARRAY, DISPLAY BOOK WITH THAT ID:
if(filter_input(INPUT_GET, $_GET_ID) != ""){
    $book_id = filter_input(INPUT_GET, $_GET_ID);
    # QUERY BOOK:
    $sqlquer = "SELECT * FROM " . $TABLE_NAME . " WHERE " . $COL_ID . "=" . $book_id;
    $sqlres = $sqlcon->query($sqlquer);

    # CHECK IF NO ERROR:
    if(!$sqlres){
        echo "Something went wrong with book request.<br>";    
    } elseif($sqlres->num_rows == 1){
        $rec = $sqlres->fetch_assoc();
        echo "<table>";
        echo "<tr>"; 
        echo "<th>" . $rec[$COL_ID] . "</th>"; 
        echo "<th><a href=\"http://127.0.0.1/index.php?id=" . $rec[$COL_ID] . "\">" . $rec[$COL_NAME] . "</a></th>"; 
        echo "<th>" . $rec[$COL_AUTH] . "</th>"; 
        echo "<th>" . $rec[$COL_PUBL] . "</th>"; 
        echo "<th>" . $rec[$COL_YEAR] . "</th>"; 
        echo "<th><img src=\"" . $rec[$COL_PICT] . "\"></th>"; 
        echo "<th>" . $rec[$COL_RATE] . "</th>"; 
        echo "<th>" . $rec[$COL_DESC] . "</th>"; 
        echo "</tr>"; 
        echo "</table>";
    } else {
            echo "Wrong page.<br>";
        }
} else {
    # QUERY ALL BOOKS:
    $sqlquer = "SELECT * FROM " . $TABLE_NAME;
    $sqlres = $sqlcon->query($sqlquer);

    # CHECK IF NO ERROR:
    if(!$sqlres){
        echo "Something went wrong with getting books from database.<br>";    
    } elseif($sqlres->num_rows > 0){
        # CREATE SIMPLE TABLE IN FOR CYCLE:
        echo "<table>";
        echo "<tr>"; 
        echo "<th>Book id:</th>"; 
        echo "<th>Book name:</th>"; 
        echo "<th>Book author:</th>"; 
        echo "<th>Book publisher:</th>"; 
        echo "<th>Year of print:</th>"; 
        echo "<th>Cover picture:</th>"; 
        echo "<th>Rating:</th>"; 
        echo "<th>Description:</th>"; 
        echo "</tr>"; 
        while($rec = $sqlres->fetch_assoc()){
                echo "<tr>"; 
                echo "<th>" . $rec[$COL_ID] . "</th>"; 
                echo "<th><a href=\"http://127.0.0.1/index.php?id=" . $rec[$COL_ID] . "\">" . $rec[$COL_NAME] . "</a></th>"; 
                echo "<th>" . $rec[$COL_AUTH] . "</th>"; 
                echo "<th>" . $rec[$COL_PUBL] . "</th>"; 
                echo "<th>" . $rec[$COL_YEAR] . "</th>"; 
                echo "<th><img src=\"" . $rec[$COL_PICT] . "\"></th>"; 
                echo "<th>" . $rec[$COL_RATE] . "</th>"; 
                echo "<th>" . $rec[$COL_DESC] . "</th>"; 
                echo "</tr>"; 
            }
            echo "</table>";
    } else {
        echo "No books to display.<br>";
    }
}

# CLOSE CONNECTION:
$sqlcon->close();
?>