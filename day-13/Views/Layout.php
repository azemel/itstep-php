<html>
<head>

<title><?=isset($viewData["Title"]) ? $viewData["Title"] : ""?></title>

<link href="<?=$this->urlToAsset("style.css")?>" type="text/css" rel="stylesheet" />

</head>

<body>

<?=$this->renderPartial("Navigation", ["active" => isset($viewData["NavigationItem"]) ? $viewData["NavigationItem"] : null])?>


<?=$this->renderBody()?>

</body>
</html>