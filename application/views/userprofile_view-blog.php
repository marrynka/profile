<div id="written">
    <h1>Last articles written:</h1>
   <div id="article1">
    
    <?php
    // Create DOM from URL or file
    if($records->written_article_1)
    {
    $html = file_get_contents($records->written_article_1);

   // Find all titles
   //echo $html;
    preg_match("/<title>(.*?)<\/title>/s", $html, $results);   
    ?> <h1><?php echo "<a href='".$records->written_article_1."'>".$results[1]."</a>";
     ?>  </h1>
     
    <?php
     $res = preg_match("/<div class=\"xhtml\">(.*?)<\/p>/s", $html, $results);  
    //echo $records->written_article_1 
    if(!$res)
    {
       preg_match("/<div class=\"perex\">(.*?)<\/div>/s", $html, $results);
    }
    echo $results[1]."</p>";
    }
    ?>
    
    </div>

  <div id="otherArticles">
        <div id="article2">
        
        
        <?php
    // Create DOM from URL or file
    if($records->written_article_2)
    {
    $html = file_get_contents($records->written_article_2);

   // Find all titles
   //echo $html;
    preg_match("/<title>(.*?)<\/title>/s", $html, $results);   
    ?> <h1><?php echo "<a href='".$records->written_article_2."'>".$results[1]."</a>";
     ?>  </h1>
     
    <?php
     $res =preg_match("/<div class=\"xhtml\">(.*?)<\/p>/s", $html, $results);  
    //echo $records->written_article_1 
    if(!$res)
    {
       preg_match("/<div class=\"perex\">(.*?)<\/div>/s", $html, $results);
    }
    echo $results[1]."</p>";
    }
    ?>
        </div>         
        <div id="article3">
        <?php
        if($records->written_article_3)
        {
    // Create DOM from URL or file
    $html = file_get_contents($records->written_article_3);

   // Find all titles
   //echo $html;
    preg_match("/<title>(.*?)<\/title>/s", $html, $results);   
    ?> <h1><?php echo "<a href='".$records->written_article_3."'>".$results[1]."</a>";
     ?>  </h1>
     
    <?php
     $res= preg_match("/<div class=\"xhtml\">(.*?)<\/p>/s", $html, $results);  
    //echo $records->written_article_1 
    if(!$res)
    {
       preg_match("/<div class=\"perex\">(.*?)<\/div>/s", $html, $results);
    }
    echo $results[1]."</p>";
    }
    ?>
        </div>
   
    
  </div>
</div>
<div id="read">
  <h1>Last articles read:</h1>
  <div id="article1">
    <?php
    if($records->read_article_1)
    {
    $html = file_get_contents($records->read_article_1);

   // Find all titles
   //echo $html;
    preg_match("/<title>(.*?)<\/title>/s", $html, $results);   
    ?> <h1><?php echo "<a href='".$records->read_article_1."'>".$results[1]."</a>";
     ?>  </h1>
     
    <?php
    $res= preg_match("/<div class=\"xhtml\">(.*?)<\/p>/s", $html, $results);  
    //echo $records->written_article_1
    if(!$res)
    {
       preg_match("/<div class=\"perex\">(.*?)<\/div>/s", $html, $results);
    } 
    echo $results[1]."</p>";
    }
     ?>
  </div>
    <div id="otherArticles">
        <div id="article2">
        
        
        <?php
    // Create DOM from URL or file
    if($records->read_article_2)
    {
    $html = file_get_contents($records->read_article_2);

   // Find all titles
   //echo $html;
    preg_match("/<title>(.*?)<\/title>/s", $html, $results);   
    ?> <h1><?php echo "<a href='".$records->read_article_2."'>".$results[1]."</a>";
     ?>  </h1>
     
    <?php
     $res = preg_match("/<div class=\"xhtml\">(.*?)<\/p>/s", $html, $results);  
    //echo $records->written_article_1 
    if(!$res)
    {
         preg_match("/<div class=\"perex\">(.*?)<\/div>/s", $html, $results);
    }
    echo $results[1]."</p>";
    }
    ?>
        </div>         
        <div id="article3">
        <?php
        if($records->read_article_3)
        {
    // Create DOM from URL or file
    $html = file_get_contents($records->read_article_3);

   // Find all titles
   //echo $html;
    preg_match("/<title>(.*?)<\/title>/s", $html, $results);   
    ?> <h1><?php echo "<a href='".$records->read_article_3."'>".$results[1]."</a>";
     ?>  </h1>
     
    <?php
     $res = preg_match("/<div class=\"xhtml\">(.*?)<\/p>/s", $html, $results);  
    //echo $records->written_article_1
    if(!$res)
    {
        preg_match("/<div class=\"perex\">(.*?)<\/div>/s", $html, $results);
    } 
    echo $results[1]."</p>";
    }
    ?>
        </div>
   
    
  </div>
  
</div>  




