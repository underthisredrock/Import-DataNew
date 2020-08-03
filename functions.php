<?php


function ProcessBrandFile($db, $fileName, $language){
    $file = fopen($fileName, "r") or die("File does not exist or you lack permission to open it");
    $line= fgets($file);
    $i=0;
    while (!feof($file))
    {
         $i++;
         ProcessBrands($line,$db, $language);
         echo "<p>" . $i . " " . $line . "</p>" ;
         $line = fgets($file);

    }
    fclose($file);
  }
  
function ProcessCategoryFile($db, $fileName, $language){
    $file = fopen($fileName, "r") or die("File does not exist or you lack permission to open it");
    $line= fgets($file);
    $i=0;
    while (!feof($file))
    {
         $i++;
         ProcessCategories($line,$db,$language);
         echo "<p>" . $i . " " . $line . "</p>" ;
         $line = fgets($file);
    }
    fclose($file);

} 
function ProcessCategories($path,$db,$language){
// category title: /html/body/div[2]/div[3]/div[3]/div[2]/div[1]/div[3]/div/div[1]/div/h1
// category content copllapsed: /html/body/div[2]/div[3]/div[3]/div[2]/div[1]/div[3]/div/div[2]/div/div/div/p[1]
// category content full: //*[@id="col-annot-ca-box-0"] o //*[@id="col-annot"]

    $filename = trim($path);
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);

# The @ before the method call suppresses any warnings that
# loadHTML might throw because of invalid HTML in the page.
    @$doc->loadHTMLFile($filename, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $xpath = new DOMXpath($doc);
    
    //VAR_DUMP(get_links($filename));
    $categoryId ="";
    $metaTitle="";
    $metaKeywords="";
    $metaDescription="";
    $URLKey="";
    $categoryCZ="";
    $categoryName="";
    $smallImage="";
    $image="";
    $description ="";
    $summary ="";
    


    $elements=null;
    $elements = $xpath->query("//meta");
    if (count($elements)>7) {  
        $tStr= $elements[8]->getAttribute('content');
        if (!is_null($tStr)) {
            $URLKey= str_replace('http://it.k8s.notino.local', '', $tStr);
        }    
    } 
    $metaTitle=$categoryId=$categoryName= str_replace("/", '', $URLKey);
    $metaKeywords= $elements[0]->getAttribute('content');
    $metaDescription= $elements[1]->getAttribute('content');
    
    $elements = $xpath->query("//*[@id='col-annot']/*[@class='ca-box']"); 
    if (!is_null($elements)) {
      foreach ($elements as $element) {
          $description= str_replace("Notino.it", 'Market Erniani',$element->nodeValue);
      }
    }
  
    $elements=null;
    $elements = $xpath->query('/html/head/script[2]');
    if (!is_null($elements)) {
      foreach ($elements as $element) {
        $tStr= $element->nodeValue;
        $start=strrpos($tStr, '"page":{"type":"Category","description":"', 0);
        $strlen=strlen('"page":{"type":"Category","description":"');
        $newstart=$start+$strlen;
        $tStr=substr($tStr,$newstart,(strlen($tStr)-$newstart));
        $end=strpos($tStr, '}');
        $test=strpos($tStr, 'te(');
        if (!$test>0) {
         $categoryCZ=substr($tStr, 0, $end-1);
            $sqlInsert = "INSERT INTO `categories`(`categoryId`, `metaTitle`, `metaKeywords`, `metaDescription`, `categoryCZ`, `categoryName`, `URLKey`, `language`, `smallImage`, `image`, `description`, `summary`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $paramType = "ssssssssssss";
            $paramArray = array( $categoryId, $metaTitle, $metaKeywords, $metaDescription, $categoryCZ, $categoryName, $URLKey, $language, $smallImage, $image, $description, $summary);
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);

            if (! empty($insertId)) {
                $type = "success";
                $message = "Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing Data";
            }
        }
      
       }
    }   
}

function ProcessBrands($path,$db,$language){
// category title: /html/body/div[2]/div[3]/div[3]/div[2]/div[1]/div[3]/div/div[1]/div/h1
// category content copllapsed: /html/body/div[2]/div[3]/div[3]/div[2]/div[1]/div[3]/div/div[2]/div/div/div/p[1]
// category content full: //*[@id="col-annot-ca-box-0"] o //*[@id="col-annot"]

    $filename = trim($path);
    $doc = new DOMDocument();
    @$doc->loadHTMLFile($filename);
    $xpath = new DOMXpath($doc);
    
    $brandId="";
    $URLKey=""; 
    $metaKeywords="";
    $metaDescription="";
    $smallImage="";
    $image="";
    $description ="";
    $longDescription ="";
    $longDescriptionTitle ="";
    $summary ="";
    $master ="";
    $sortorder =0;
    $featuredBrand ="";
    $storeView ="";
    

    $elements=null;
    $elements = $xpath->query("//meta");
    if (count($elements)>7) {  
        $tStr= $elements[8]->getAttribute('content');
        if (!is_null($tStr)) {
            $URLKey= str_replace('http://it.k8s.notino.local', '', $tStr);
        } else {
          print $filename;  
        }    
    } else {
      print $filename;  
    } 
    $URLKey= str_replace('http://it.k8s.notino.local', '', $elements[8]->getAttribute('content'));
    $len=strlen($URLKey);
    $tStr=substr($URLKey, 1, ($len-2));
    $pos=0;
    $pos=strpos($tStr, '/');
    $len=strlen($tStr);
    $metaTitle=$brandId=$tStr;
    if ($pos>0 and $len > $pos) {
        $master="no";
    } else {
        $master="yes";
    }
    $metaKeywords= $elements[0]->getAttribute('content');
    $metaDescription= $elements[1]->getAttribute('content');
    
    $elements = $xpath->query("//*[@class='text-brand-text collapsable']/*[@class='ca-box']"); 
    if (!is_null($elements)) {
      foreach ($elements as $element) {
          $description= str_replace("Notino.it", 'Market Erniani',$element->nodeValue);
          $featuredBrand="Yes";
      }
    }
    $elements = $xpath->query("//*[@class='category-component category-component--seo-text collapsable']/*[@class='component-title center']");
    if (!is_null($elements)) {
      foreach ($elements as $element) {
        $longDescriptionTitle= $element->nodeValue;
      }
    }  
    $elements = $xpath->query("//*[@class='category-component category-component--seo-text collapsable']/*[@class='ca-box']");
    if (!is_null($elements)) {
      foreach ($elements as $element) {
        $longDescription= $element->nodeValue;
      }
    }
  
    $elements = $xpath->query("//*[@class='component-title']/img/attribute::src"); 
    if (!is_null($elements)) {
      foreach ($elements as $element) {
         $image = $element->value;
        }
    }
       
    $sqlInsert = "INSERT INTO `brands`(`brandId`, `URLKey`, `metaKeywords`, `metaDescription`, `language`, `description`, `longDescription`, `longDescriptionTitle`,`summary`, `sortorder`, `smallImage`, `image`, `featuredBrand`, `master`, `storeView`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $paramType = "sssssssssdsssss";
    $paramArray = array($brandId, $URLKey, $metaKeywords, $metaDescription, $language, $description, $longDescription, $longDescriptionTitle, $summary, $sortorder, $smallImage, $image, $featuredBrand, $master, $storeView);
        
    $insertId = $db->insert($sqlInsert, $paramType, $paramArray);

    if (! empty($insertId)) {
        $type = "success";
        $message = "Data Imported into the Database";
    } else {
        $type = "error";
        $message = "Problem in Importing Data";
    }
    
}



function get_all_records(){
    $con = getdb();
    $Sql = "SELECT * FROM employeeinfo";
    $result = mysqli_query($con, $Sql);  


    if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead><tr><th>EMP ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Registration Date</th>
                        </tr></thead><tbody>";


     while($row = mysqli_fetch_assoc($result)) {

         echo "<tr><td>" . $row['emp_id']."</td>
                   <td>" . $row['firstname']."</td>
                   <td>" . $row['lastname']."</td>
                   <td>" . $row['email']."</td>
                   <td>" . $row['reg_date']."</td></tr>";        
     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "you have no records";
}
 if(isset($_POST["Export"])){
     
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID', 'First Name', 'Last Name', 'Email', 'Joining Date'));  
      $query = "SELECT * from employeeinfo ORDER BY emp_id DESC";  
      $result = mysqli_query($con, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
}

function get_links($url) {

    // Create a new DOM Document to hold our webpage structure
    $xml = new DOMDocument();

    // Load the url's contents into the DOM
    $xml->loadHTMLFile($url);

    // Empty array to hold all links to return
    $links = array();

    //Loop through each <a> tag in the dom and add it to the link array
    foreach($xml->getElementsByTagName('a') as $link) {
        $links[] = array('url' => $link->getAttribute('href'), 'text' => $link->nodeValue);
    }

    //Return the links
    return $links;
}

 ?>