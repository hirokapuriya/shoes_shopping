<?php
		require_once("classes/dbo.class.php");
		
		 $result = "SELECT * FROM categories";
		$res = $db->get($result);
        //create a multidimensional array to hold a list of category and parent category
        $category = array(
            'categories' => array(),
            'parent_cats' => array()
        );
 
        //build the array lists with data from the category table
		
		
		while($row = mysqli_fetch_assoc($res))
		{
            //creates entry into categories array with current category id ie. $categories['categories'][1]
            $category['categories'][$row['cat_id']] = $row;
            //creates entry into parent_cats array. parent_cats array contains a list of all categories with children
            $category['parent_cats'][$row['cat_parent_id']][] = $row['cat_id'];
        }
		
function buildCategory($parent, $category) {
		
	$html = "";
	if (isset($category['parent_cats'][$parent])) {
		$html .= "<ul  id='navy' class='clearfix'>\n";
		foreach ($category['parent_cats'][$parent] as $cat_id) {
			if (!isset($category['parent_cats'][$cat_id])) {
				$html .= "<li class='normal_menu'><a href='products.php?id=".$category['categories'][$cat_id]['cat_id']."'>".$category['categories'][$cat_id]['cat_nm']."</a></li> \n";
			}
			if (isset($category['parent_cats'][$cat_id])) {
				$html .= "<li class='normal_menu'><a href='products.php?id=".$category['categories'][$cat_id]['cat_id']."'>".$category['categories'][$cat_id]['cat_nm']."</a> \n";
				$html .= buildCategory($cat_id, $category);
				$html .= "</li> \n";
			}
		}
		$html .= "</ul> \n";
	}
	return $html;
}
?>
<ul>
                <li><a href="index.php" class="selected">Home</a></li>
                <li>
					<a href="">Products</a>
					<?php echo buildCategory(0, $category); ?>
                </li>
                <li><a href="about.php">About</a>
                    <ul>
                        <li><a rel="nofollow" href="http://www.templatemo.com/page/1">Sub menu 1</a></li>
                        <li><a rel="nofollow" href="http://www.templatemo.com/page/2">Sub menu 2</a></li>
                        <li><a rel="nofollow" href="http://www.templatemo.com/page/3">Sub menu 3</a></li>
                  </ul>
                </li>
                <li><a href="faqs.php">FAQs</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>