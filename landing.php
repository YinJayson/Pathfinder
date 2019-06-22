<html>
    <head>
        <style>
            body {
                background-color: #333;
            }
            .color {
                background-color: #eee;
            }
            .center {
                margin: auto;
                width: 50%;
                border: 3px solid #eee;
                text-align: center;
                font-family: Arial, sans-serif;
                padding: 1rem;
            }
            .poster_name
            {
                font-size: 1rem;
            }
            button {
                background-color: red; /* Green */
                border: none;
                color: white;
                padding: .75rem .75rem;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="center color">
            <?php 
            session_start();
                if (isset($_SESSION['ID'])) {
                    $conn = "mysql:host=127.0.0.1;port=3306;dbname=meatlab";
                    try{
                        $db = new PDO($conn, "root", "", [
                            PDO::ATTR_PERSISTENT => true
                            ]);
                        $statement = $db->prepare("SELECT * FROM `posts`");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                        echo '<div><strong>Current User: '.$_SESSION['ID'].'</strong></div></br>';
                        foreach ($result as $post) {
                            echo "<div>";
                            echo "<h1>{$post->title}<div class='poster_name'> by {$post->poster_name}</div></h1>";
                            echo "<p>{$post->body}<p>";
                            echo "</div>";
                        }
                    } catch (PDOException $e) {
                        echo 'Something went wrong in fetching the database in landing';
                    }
                    $db = null;
                }
                else
                {
                    $_SESSION['ERROR_MESSAGE'] = "Please login or register first!";
                    header('Location: http://localhost:8080/pathfinder/login.php');
                }
            ?>
            <br>
            <a href="./post.html">Post</button>
            <form action="./logout.php" method="post">
                <button type="submit">Log Out</button>
            </form>
        </div>
    </body>
</html>