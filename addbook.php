<?php
  include 'include/dbconnection.php';  
?>
<html>

<head>
	<title>Book Information</title>
    <link href="assets/css/reg.css" rel="stylesheet">
</head>

<body>
	<form action="" method="post">
	<h1>Library Database</h1>
	<fieldset>
		<legend>Book Information</legend>
		<label>Title:</label> <input type="text" name="title" required/><br />
		<label>Pages:</label> <input type="number" min=1 name="pages" required/><br />
		<label>Author:</label> <input type="text" name="author" required/><br />
		<label>Published Year:</label> <input type="text" name="year" required/>
        <div><br/></div>
    <input style="float:right" type="submit" value="Add Book" onClick="return submit_form();" name="submit"/>
    <?php
        if(isset($_POST['title']) &&
           isset($_POST['pages']) &&
           isset($_POST['author']) &&
           isset($_POST['year']))
        {
            $title = $_POST['title'];
            $pages = $_POST['pages'];
            $author = $_POST['author'];
            $year = $_POST['year'];
            $query = "INSERT INTO book(title,pages,author,year) VALUES('$title',$pages,'$author',$year)";
            mysqli_query($dbconn,$query);
        }
    ?>
    </fieldset>
    <h3>List of Stored Books</h3>
    <table border="2" align="center" cellpadding=5>
            <thead>
                <tr><th>Title</th>
                    <th>Pages</th>
                    <th>Author</th>
                    <th>Published Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM book";
                if ($result = mysqli_query($dbconn, $query)){
                    while ($row = mysqli_fetch_assoc($result)){
                        $title = $row['title'];
                        $pages = $row['pages'];
                        $author = $row['author'];
                        $year = $row['year'];
                        echo "
                        <tr><td>$title</td>
                            <td>$pages</td>
                            <td>$author</td>
                            <td>$year</td>
                            <td><input type='button' value='Edit'/></td>";
                    }
                }
                ?>
            </tbody>
        </table>
	</form>
    <script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
	<script type="text/javascript">
		function submit_form(){
			alert("A new book has been successfully added!");
		}
	</script>
<?php 
    $dbconn->close();
    ?>
</body>
</html>