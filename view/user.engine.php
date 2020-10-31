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
        function send() {
            let array = []
            $inputs = $('.form-control').each(function (){
                array.push($(this).val());
            })


            $.ajax({
                url: '/mbou4260/lesson/users/work/send',
                method: 'post',
                dataType: 'text',
                data: {send: array},
                success: function (data) {
                    console.log(data);
                }
            })
        }
    </script>

    <title>Students</title>
</head>
<body>
<?php for ($i = 1;$i <= count($legend);):?>
<?php foreach($legend as $task):?>
<p style="text-align: center; padding-top: 20px;margin-top: 50px"> <? echo $task;?></p>
    <div class="form-group" style="width: 30%;padding-top: 5%;margin-left: auto;margin-right: auto">
        <label for="comment">Code:</label>
        <textarea class="form-control" rows="10" id="comment"><?php echo "function work$i() {\n\n}"?></textarea>
        <button type="button" class="btn btn-primary btn-sm" style="float: right;margin-top: 5px">Сохранить</button>
    </div>
    <?$i++?>
<?endforeach;?>
<?endfor;?>
<div style="margin-top: 50px;margin-left: auto;margin-right: auto;float: right;">
<button type="button" class="btn btn-primary btn-sm" id="send" onclick="send()">Отправить на проверку</button>
</div>
</body>
</html>
