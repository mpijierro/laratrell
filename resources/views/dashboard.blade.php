<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')

</head>
<body class="">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laratrell</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{!! route('dashboard') !!}">Home</a></li>
                <li class="active"><a href="https://github.com/mpijierro/laratrell" target="_blank">GitHub</a></li>
                <li><a href="{!! route('logout') !!}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid" style="margin-top:50px">

    <div class="row">
        <div class="col-xs-12">

            @foreach ($builder->getBoardsDoing() as $boardDoing)

                <div class="col-xs-12 col-sm-3">

                    <h3 class="header smaller lighter green">
                        <i class="ace-icon fa fa-bullhorn"></i>

                        {!! $boardDoing->getOrganizationName() !!} - {!! $boardDoing->getBoardName() !!}
                    </h3>

                    <div class="alert alert-info">
                        @foreach ($boardDoing->getCards() as $card)
                            * <a href='{!! $card->getShortUrl() !!}' target='_blank' title="Show card in Trello">{!! $card->getName() !!}</a><br><br>
                        @endforeach
                    </div>


                </div>

            @endforeach

        </div>

    </div>
</div>

</body>
</html>
