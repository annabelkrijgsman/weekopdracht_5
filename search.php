<?php
    include 'header.php';
?>
<br/>
    <div class="row">
        <article>
            <div class="left">
                    
                <select id="selectcategory" class="button" onchange="selectCategory();">
                    <option value=''>Select Category</option>
            
                        <?php
                        
                            if (isset($_GET["cat"])) {
                                $catname = $_GET["cat"];
                            }
                            else {
                                $catname = "";
                            }
                        
                            $sql = "SELECT * FROM Categories"; 
                            
                            $result = $connection->query($sql);
                                foreach ($result as $row)	{
                                    $selected = "";
                                    
                                    if ($catname == $row["ID"]) {
                                        $selected = "selected='selected'";
                                    }
                                    echo "<option value =" . $row['ID'] . " " . $selected . "> " . $row["Catname"] . " </option> ";
                                }
                         
                        ?> 				 				
                </select>
                
                <form action="search.php" method="POST">    
                    
                    <input class="searchbox" type="text" name="search" placeholder="Search">    
                    <button type="sumbit" name="submitsearch" class="button">Search</button>
                    
                    
                </form>
                
                <br/>								
                <hr/>
                <br/>

                        <?php
                            
                            if (isset($_POST['submitsearch'])) {
                                $search = $_POST["search"];
                                $sql = "SELECT * FROM Blogposts
                                        WHERE Title LIKE '%$search%'
                                        OR Post LIKE '%$search%'
                                        OR Username LIKE '%$search%'
                                        OR Date LIKE '%$search%'";
                            
                                
                                $result = $connection->query($sql);
                                $result->execute();
                                $queryResult = $result->fetchColumn();
                                
                                $result = $connection->query($sql);
                                    foreach ($result as $row) {
                                        echo "<div class='artcilebox'>
                                        <p>Author: " . $row['Username'] ."</p>
                                        <h3>" . $row['Title'] . "</h3>
                                        <p>" . $row['Post'] . "</p>
                                        <p>" . $row['Date'] . "</p>
                                        </div><hr/>";
                                    }   
                            }
                            
                         ?>   
                    
            </div>
        </article>
        
        <aside>

            <?php
                include 'aside.php';
            ?>

        </aside>
       <br/>
      <br/>
    </div>
    
<?php
    include 'footer.php';
?>