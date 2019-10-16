<?php

function get_all_posts()
{
    global $db;
    $sth = $db->query("SELECT p.id as id, p.title as title, content, id_cat, c.title as cat_title FROM posts as p, categorie as c WHERE id_cat = c.id");

    
    return $sth->fetchAll();
}

function create_post($titre, $contenu, $caty)
{
	global $db;

	$db->query("INSERT INTO posts (title,content,id_cat) VALUES ('$titre','$contenu',$caty)");
	
	
}

if(isset($_POST)) {
	if(isset($_POST['titre'])&& isset($_POST['contenu']))
	{

	$titre = $_POST['titre'];
	$contenu = $_POST['contenu'];
	$caty=0;
	create_post($titre, $contenu, $caty);

	}
	if(isset($_POST['indice']))
	{
	$id=$_POST['indice'];
	supp_post($id);
	}

	if(isset($_POST['ind'])&& isset($_POST['modif-tit']))
	{
		if($_POST['modif-tit'] != "")
		{
			$titre=$_POST['modif-tit'];
			$id=$_POST['ind'];
			modif_post($id,$titre);
		}
	}

    if(isset($_POST['ind'])&& isset($_POST['modif-con']))
	{
		if($_POST['modif-con'] != "")
		{
			$contenu=$_POST['modif-con'];
			$id=$_POST['ind'];
			modif_con_post($id,$contenu);
		}
	}

	if(isset($_POST['ind'])&& isset($_POST['modif-caty']))
	{
		if($_POST['modif-caty'] != "")
		{
			$id =$_POST['ind'];
			$caty = $_POST['modif-caty'];
			modif_caty_post($id,$caty);
		}
	}
	/*if(isset($_POST['modif-cat']))
	{
			$id =$_POST['modif-cat'];
			$caty = $db->query("SELECT title from categorie where id=$id ");
			modif_cat($id);
		
	}*/
}



function supp_post($id)
{
	global $db;

	$db->query("DELETE FROM posts WHERE id = $id ");
	
}


function modif_post($id,$titre)

{
	global $db;

	$db->query("UPDATE posts set title = '$titre' WHERE id=$id ");

}


function modif_con_post($id,$contenu)
{
	global $db;

	$db->query("UPDATE posts set content = '$contenu' WHERE id=$id ");

}



function modif_caty_post($id,$caty)
{
	global $db;

	$db->query("UPDATE posts set id_cat = $caty WHERE id=$id ");

}

/*function modif_cat($id,$caty)
{
	global $db;

	$db->query("UPDATE posts set id_cat = $caty WHERE id=$id ");

}*/






















