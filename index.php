<?php 
# DB CONSTANTS:
$TABLE_NAME = 'Books';
$COL_ID = 'id';
$COL_NAME = 'book_name';
$COL_AUTH = 'book_author';
$COL_PUBL = 'book_publisher';
$COL_YEAR = 'book_year';
$COL_PICT = 'picture_url';
$COL_RATE = 'rating';
$COL_DESC = 'description';
# PAGE STATE:
$PS_NO_ERROR = "";
$PS_ERROR_MSG = "";


# ------------------------------------------------------ 
# ---------------------- ROUTING ----------------------- 
# ------------------------------------------------------ 
$ROUT_INDEX = "/index.php";
$ROUT_DETAILS = "id";

function redirect_link($from, $to, $val){
    return $from . "?" . $to . "=" . $val;
}

# ------------------------------------------------------ 
# ---------------------- CONTROL ----------------------- 
# ------------------------------------------------------ 

# CONNECT TO DATABASE:
$sqlcon = new mysqli('localhost', 'user', 'qQ1wW2eE3!', 'php');

# HANDLE DB CONNECION ERROR:
if ($sqlcon -> connect_error) {
    $PS_ERROR_MSG = "Something went wrong with database connection.<br>";
}

# IF BOOK IS IN GET ARRAY, DISPLAY BOOK WITH THAT ID:
if(filter_input(INPUT_GET, $ROUT_DETAILS) != ""){
    $book_id = filter_input(INPUT_GET, $ROUT_DETAILS);
    # QUERY BOOK:
    $sqlquer = "SELECT * FROM " . $TABLE_NAME . " WHERE " . $COL_ID . "=" . $book_id;
    $sqlres = $sqlcon->query($sqlquer);

    # CHECK IF NO ERROR:
    if(!$sqlres){
        $PS_ERROR_MSG = "Something went wrong with book request.<br>";    
    } elseif($sqlres->num_rows != 1){
        $PS_ERROR_MSG = "Wrong page link.<br>";
    }
} else {
    # QUERY ALL BOOKS:
    $sqlquer = "SELECT * FROM " . $TABLE_NAME;
    $sqlres = $sqlcon->query($sqlquer);

    # CHECK IF NO ERROR:
    if(!$sqlres){
        $PS_ERROR_MSG = "Something went wrong with getting books from database.<br>";    
    } elseif($sqlres->num_rows == 0){
        $PS_ERROR_MSG = "No books to display.<br>";
    }
}

# CLOSE CONNECTION:
$sqlcon->close();
?>
<!-- ------------------------------------------------------ -->
<!-- ------------------------ VIEW ------------------------ -->
<!-- ------------------------------------------------------ -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Books database</title>
</head>
<body>
    <?php
    if ($PS_ERROR_MSG != $PS_NO_ERROR){
        echo $PS_ERROR_MSG;
    } else {
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
                echo "<th><a href=\"" . redirect_link($ROUT_INDEX, $ROUT_DETAILS, $rec[$COL_ID]) . "\">" . $rec[$COL_NAME] . "</a></th>"; 
                echo "<th>" . $rec[$COL_AUTH] . "</th>"; 
                echo "<th>" . $rec[$COL_PUBL] . "</th>"; 
                echo "<th>" . $rec[$COL_YEAR] . "</th>"; 
                echo "<th><img src=\"" . $rec[$COL_PICT] . "\"></th>"; 
                echo "<th>" . $rec[$COL_RATE] . "</th>"; 
                echo "<th>" . $rec[$COL_DESC] . "</th>"; 
                echo "</tr>"; 
            }
            echo "</table>";
    }
    ?>
</body>
</html> 