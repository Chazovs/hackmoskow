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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
          crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script>
        function sendData(work) {
        	let user = '#'+ work +'user';
        	let comment = '#'+ work +'comment';

            $.ajax({
                url: '/mbou4260/lesson/users/work/save',
                method: 'post',
                dataType: 'text',
                data: {
					comment: $(comment).val(),
					work:  work,
                	user: $(user).val()
                },
                success: function (data) {
                    console.log(data);
                }
            })
        }
    </script>

    <title>Students</title>
</head>
<body>

<?php

foreach($datasetToSend as $task):?>
<p style="text-align: center; padding-top: 20px;margin-top: 50px"> <? echo $task['legend'];?></p>
    <div class="form-group" style="width: 30%;padding-top: 5%;margin-left: auto;margin-right: auto">
	    <input type="hidden" id="<?= $task['work']?>user" value="<?= $task['user']?>">
        <label for="comment">Code:</label>
        <textarea class="form-control" rows="10" id="<?= $task['work']?>comment"><?php echo "function " . $task['work'] ."() {\n\n}"?></textarea>
        <button type="button" class="btn btn-primary btn-sm" onclick="sendData('<?= $task['work']?>')" style="float: right;margin-top: 5px">Сохранить</button>
    </div>
<?endforeach;?>
<div style="margin-top: 50px;margin-left: auto;margin-right: auto;float: right;">
<button type="button" class="btn btn-primary btn-sm" id="send" onclick="send('<?= $task['work']?>')">Отправить на проверку</button>
</div>
</body>
</html>
