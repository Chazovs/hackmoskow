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
			const elems      = $(".test-block");
			const elemsTotal = elems.length;
			let formFields   = [];
			for (var i = 0; i < elemsTotal; ++i) {
				let firstParam  = $(elems[i]).find(".first-param").val();
				let secondParam = $(elems[i]).find(".second-param").val();
				let output      = $(elems[i]).find(".output").val();
				let variant      = $(elems[i]).find(".variant").val();
				let students    = $(elems[i]).find(".students").val();
				formFields[i]   = {
					'firstParam':  firstParam,
					'secondParam': secondParam,
					'output':      output,
					'students':    students,
					'variant':    variant
				}
			}
			let json = JSON.stringify(formFields);
			$.ajax({
				url:      '/mbou4260/lesson/start',         /* Куда пойдет запрос */
				method:   'post',             /* Метод передачи (post или get) */
				dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */
				data:     {'result': json},     /* Параметры передаваемые в запросе. */
				success:  function(data) {   /* функция которая будет выполнена после успешного запроса.  */
					alert(data);            /* В переменной data содержится ответ от index.php. */
				}
			});
		}

		let variantNumber = 0;

		function addVariant() {
			$('#variants').append(
				"<div class=\"test-block\" >" +
				"		<input type=\"hidden\" class=\"variant\" value=\"work"+variantNumber+"\" required=\"\">\n" +
				"<div class=\"row test-param-1\">" +
				"	<div class=\"col-md-4 mb-3\">" +
				"		<label for=\"firstName\">Первый параметр</label>" +
				"		<input type=\"text\" class=\"first-param\" value=\"\" required=\"\">\n" +
				"	</div>" +
				"	<div class=\"col-md-4 mb-3\">" +
				"		<label for=\"lastName\">Второй параметр</label>" +
				"		<input type=\"text\" class=\"second-param\" id=\"lastName\" placeholder=\"\" value=\"\" required=\"\">" +
				"	</div>" +
				"	<div class=\"col-md-4 mb-3\">" +
				"		<label for=\"address\">Выходной параметр</label>" +
				"		<input type=\"text\" class=\"output\" id=\"address\"  required=\"\">" +
				"	</div>" +
				"</div>" +
				"		<div class=\"form-group\">" +
				"<label for=\"exampleFormControlSelect2\">Ученики</label>" +
				"<select multiple class=\"form-control students\">" +
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
	<form class="needs-validation">
		<div id="variants">

		</div>
		<a href="javascript:void(0)" onclick="addVariant(variantNumber++)">Добавить вариант</a>
		<hr class="mb-4">
		<a class="btn btn-primary" href="javascript:void(0)" onclick="addLesson()" role="button">Создать урок</a>
	</form>

</div>
</body>
</html>