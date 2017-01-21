<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')

</head>
<body class="">


<div class="content">

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
