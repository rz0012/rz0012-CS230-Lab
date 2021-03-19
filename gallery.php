
<?php
require 'includes/header.php';
/*
<script type="text/javascript">
                            var id = <?php echo $_GET["id"];?>;
                            var rateIndex = -1;
                            xhr_getter("includes/get-ratings.php?id="$row["pid"], "testAvg");

                            function xhr_getter(prefix, element) {
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    // If the GET request was successful, fill in the span element with the review_list id with reviews
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById(element).innerHTML = this.responseText;
                                    }
                                };
                                url = prefix + id;
                                xhttp.open("GET", url, true);
                                xhttp.send();
                            }

                        </script>*/
?>


<main>
    <link rel="stylesheet" href='css/gallery.css'>
    <h1>Gallery</h1>
    <h3>This contains all the images that have been uploaded to the gallery by the admin</h3>
    <div class="gallery-container">
        <?php include_once 'includes/dbhandler.php';
        $sql ="SELECT * FROM gallery ORDER BY upload_date DESC";
        $query = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($query)){
            echo'
            
                    <div class="card">
                    <a href="review.php?id='.$row['pid'].'">
                        <img src="gallery/'.$row["picpath"].'">
                        <h3>'.$row["title"].'</h3>
                        <p>'.$row["descript"].'</p>
                        
                    </a>
                </div>';
        }
        ?>

    </div>
    
    </div>

</main>