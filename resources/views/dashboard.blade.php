<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LaraTrell - You are doing...</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
          crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

</head>
<body class="">


<div class="content">

    <div class="row">
        <div class="col-xs-12">

            @foreach ($workingBoards as $boardDoing)

                <div class="col-xs-12 col-sm-3">

                    <h3 class="header smaller lighter green">
                        <i class="ace-icon fa fa-bullhorn"></i>

                        {!! $organizations->getOrganizationNameById($boardDoing->getIdOrganization()) !!} - {!! $boardDoing->getName() !!}
                    </h3>

                    <div class="alert alert-info">
                        @foreach ($boardDoing->getCardsDoing() as $card)
                            * <a href='{!! $card['shortUrl'] !!}' target='_blank' title="Show card in Trello">{!! $card['name'] !!}</a><br><br>
                        @endforeach
                    </div>


                </div>

            @endforeach
        </div>

    </div>
</div>

</body>
</html>
