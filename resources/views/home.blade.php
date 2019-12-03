@extends('layouts.master')
@section('title','ChessCloud')
@section('content')
<meta charset="UTF-8">
<!--
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
-->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="container">
	<div class="row">
		<!-- Carousel -->
    	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
			  	<li data-target="#chess1" data-slide-to="0"></li>
			    <li data-target="#chess2" data-slide-to="1"></li>
			    <li data-target="#chess3" data-slide-to="2"></li>
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
			    <div class="item active">
			    	<img src="images/chess1.jpg" alt="First slide" class=".slicer">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                            	<span>Bienevenido a <strong>ChessCloud</strong></span>
                            </h2>
                            <br>
                            <h3>
                            	<span>Sitio web diseñado y creado por Serverslayer</span>
                            </h3>
                            <br>
                            <div class="">
                                <a class="btn btn-theme btn-sm btn-min-block" href="/entrar">Entrar</a>
                                <a class="btn btn-theme btn-sm btn-min-block" href="/registrar">Registrar</a>
                            </div>
                        </div>
                    </div><!-- /header-text -->
			    </div>
			    <div class="item">
			    	<img src="images/chess2.jpg" alt="Second slide">
			    	<!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                            	<span>Bienevenido a <strong>ChessCloud</strong></span>
                            </h2>
                            <br>
                            <h3>
                            	<span>Sitio web diseñado y creado por Serverslayer</span>
                            </h3>
                            <br>
                            <div class="">
                                <a class="btn btn-theme btn-sm btn-min-block" href="/entrar">Entrar</a>
                                <a class="btn btn-theme btn-sm btn-min-block" href="/registrar">Registrar</a>
                            </div>
                        </div>
                    </div><!-- /header-text -->
			    </div>
			    <div class="item">
			    	<img src="images/chess3.jpg" alt="Third slide">
			    	<!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                            	<span>Bienevenido a <strong>ChessCloud</strong></span>
                            </h2>
                            <br>
                            <h3>
                            	<span>Sitio web diseñado y creado por Serverslayer</span>
                            </h3>
                            <br>
                            <div class="">
                                <a class="btn btn-theme btn-sm btn-min-block" href="/entrar">Entrar</a>
                                <a class="btn btn-theme btn-sm btn-min-block" href="/registrar">Registrar</a>
                            </div>
                        </div>
                    </div><!-- /header-text -->
			    </div>
			</div>
			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		    	<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		    	<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div><!-- /carousel -->
	</div>
</div>

@endsection