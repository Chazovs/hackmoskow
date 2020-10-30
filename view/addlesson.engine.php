<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script
		src="https://code.jquery.com/jquery-3.5.1.js"
		integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
		crossorigin="anonymous"></script>

	<script>
		function addLesson() {
			var elems = $(".test-block");
			var elemsTotal = elems.length;
			for(var i=0; i<elemsTotal; ++i){
				$(elems[i]).attr('id', i)
			}
			console.log(elemsTotal);
		}

		let variantNumber = 0;
		function addVariant() {
		$('#variants').append(
			"<div class=\"test-block\" >" +
			"<div class=\"row test-param-1\">" +
			"	<div class=\"col-md-4 mb-3\">" +
			"		<label for=\"firstName\">Первый параметр</label>" +
			"		<input type=\"text\" class=\"form-control\" id=\"firstName\" placeholder=\"\" value=\"\" required=\"\">\n" +
			"	</div>" +
			"	<div class=\"col-md-4 mb-3\">" +
			"		<label for=\"lastName\">Второй параметр</label>" +
			"		<input type=\"text\" class=\"form-control\" id=\"lastName\" placeholder=\"\" value=\"\" required=\"\">" +
			"	</div>" +
			"	<div class=\"col-md-4 mb-3\">" +
			"		<label for=\"address\">Выходной параметр</label>" +
			"		<input type=\"text\" class=\"form-control\" id=\"address\"  required=\"\">" +
			"	</div>" +
			"</div>" +
			"		<div class=\"form-group\">" +
			"<label for=\"exampleFormControlSelect2\">Ученики</label>" +
			"<select multiple class=\"form-control\" id=\"exampleFormControlSelect2\">" +
			"	<option value=\"Daniil\">Даниил Сухорада</option>" +
			"	<option value=\"Yra\">Юрий Пекарь</option>" +
			"	<option value=\"Sergey\">Сергей Чазов</option>" +
			"</select>\n		</div>" +
			"</div>"
		);
		}

	</script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	      crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
	      crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
	        crossorigin="anonymous"></script>

	<title>Document</title>
</head>
<body>
<div class="col-md-8 order-md-1">
	<h4 class="mb-3">Задание</h4>
	<form class="needs-validation" >
<div id="variants">

</div>
		<a href="javascript:void(0)" onclick="addVariant(variantNumber++)">Добавить вариант</a>
		<hr class="mb-4">
		<a class="btn btn-primary" href="javascript:void(0)" onclick="addLesson()" role="button">Создать урок</a>
	</form>

</div>
</body>
</html>