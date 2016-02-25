<?
use yii\helpers\Html;
use yii\bootstrap\Nav;
\frontend\assets\MainAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title><?=$this->title ?> </title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?=Html::csrfMetaTags() ?>
        <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<!-- Header Starts -->
<div class="navbar-wrapper">
    <div class="navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.html" >Home</a></li>
                    <li><a href="about.html" >About</a></li>
                    <li><a href="agents.html" >Agents</a></li>
                    <li><a href="blog.html" >Blog</a></li>
                    <li><a href="contact.html" >Contact</a></li>
                </ul>
            </div>
            <!-- #Nav Ends -->
        </div>
    </div>
</div>
<!-- #Header Starts -->
<div class="container">

        <!-- Header Starts -->
        <div class="header">
            <a href="index.html" ><img src="images/logo.png"  alt="Realestate"></a>

            <ul class="pull-right">
                <li><a href="buysalerent.html" >Buy</a></li>
                <li><a href="buysalerent.html" >Sale</a></li>
                <li><a href="buysalerent.html" >Rent</a></li>
            </ul>
        </div>
        <!-- #Header Starts -->
    </div>
    <div class="">
        <div id="slider" class="sl-slider-wrapper">
            <div class="sl-slider">
                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-1"></div>
                        <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
                        <blockquote>
                            <p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>
                            <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>
                            <cite>$ 20,000,000</cite>
                        </blockquote>
                    </div>
                </div>

                <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-2"></div>
                        <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
                        <blockquote>
                            <p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>
                            <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>
                            <cite>$ 20,000,000</cite>
                        </blockquote>
                    </div>
                </div>

                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-3"></div>
                        <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
                        <blockquote>
                            <p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>
                            <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>
                            <cite>$ 20,000,000</cite>
                        </blockquote>
                    </div>
                </div>

                <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-4"></div>
                        <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
                        <blockquote>
                            <p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>
                            <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>
                            <cite>$ 20,000,000</cite>
                        </blockquote>
                    </div>
                </div>

                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-5"></div>
                        <h2><a href="#">2 Bed Rooms and 1 Dinning Room Aparment on Sale</a></h2>
                        <blockquote>
                            <p class="location"><span class="glyphicon glyphicon-map-marker"></span> 1890 Syndey, Australia</p>
                            <p>Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>
                            <cite>$ 20,000,000</cite>
                        </blockquote>
                    </div>
                </div>
            </div><!-- /sl-slider -->



            <nav id="nav-dots" class="nav-dots">
                <span class="nav-dot-current"></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </nav>

        </div><!-- /slider-wrapper -->
    </div>



    <div class="banner-search">
        <div class="container">
            <!-- banner -->
            <h3>Buy, Sale & Rent</h3>
            <div class="searchbar">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <input type="text" class="form-control" placeholder="Search of Properties">
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 ">
                                <select class="form-control">
                                    <option>Buy</option>
                                    <option>Rent</option>
                                    <option>Sale</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <select class="form-control">
                                    <option>Price</option>
                                    <option>$150,000 - $200,000</option>
                                    <option>$200,000 - $250,000</option>
                                    <option>$250,000 - $300,000</option>
                                    <option>$300,000 - above</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <select class="form-control">
                                    <option>Property</option>
                                    <option>Apartment</option>
                                    <option>Building</option>
                                    <option>Office Space</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <button class="btn btn-success"  onclick="window.location.href='buysalerent.html'">Find Now</button>
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-5 col-lg-offset-1 col-sm-6 ">
                        <p>Join now and get updated with all the properties deals.</p>
                        <button class="btn btn-info"   data-toggle="modal" data-target="#loginpop">Login</button>        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner -->
    <div class="container">
        <div class="properties-listing spacer"> <a href="buysalerent.html"  class="pull-right viewall">View All Listing</a>
            <h2>Featured Properties</h2>
            <div id="owl-example" class="owl-carousel">
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/1.jpg"  class="img-responsive" alt="properties"/>
                        <div class="status sold">Sold</div>
                    </div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/2.jpg"  class="img-responsive" alt="properties"/>
                        <div class="status new">New</div>
                    </div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/3.jpg"  class="img-responsive" alt="properties"/></div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/4.jpg"  class="img-responsive" alt="properties"/></div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/1.jpg"  class="img-responsive" alt="properties"/>
                        <div class="status sold">Sold</div>
                    </div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/2.jpg"  class="img-responsive" alt="properties"/>
                        <div class="status sold">Sold</div>
                    </div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/3.jpg"  class="img-responsive" alt="properties"/>
                        <div class="status new">New</div>
                    </div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/4.jpg"  class="img-responsive" alt="properties"/></div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/1.jpg"  class="img-responsive" alt="properties"/></div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/2.jpg"  class="img-responsive" alt="properties"/></div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>
                <div class="properties">
                    <div class="image-holder"><img src="images/properties/3.jpg"  class="img-responsive" alt="properties"/></div>
                    <h4><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Royal Inn</a></h4>
                    <p class="price">Price: $234,900</p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>
                    <a class="btn btn-primary" href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >View Details</a>
                </div>

            </div>
        </div>
        <div class="spacer">
            <div class="row">
                <div class="col-lg-6 col-sm-9 recent-view">
                    <h3>About Us</h3>
                    <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br><a href="about.html" >Learn More</a></p>

                </div>
                <div class="col-lg-5 col-lg-offset-1 col-sm-3 recommended">
                    <h3>Recommended Properties</h3>
                    <div id="myCarousel" class="carousel slide">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                            <li data-target="#myCarousel" data-slide-to="3" class=""></li>
                        </ol>
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="row">
                                    <div class="col-lg-4"><img src="images/properties/1.jpg"  class="img-responsive" alt="properties"/></div>
                                    <div class="col-lg-8">
                                        <h5><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Integer sed porta quam</a></h5>
                                        <p class="price">$300,000</p>
                                        <a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27"  class="more">More Detail</a> </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-lg-4"><img src="images/properties/2.jpg"  class="img-responsive" alt="properties"/></div>
                                    <div class="col-lg-8">
                                        <h5><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Integer sed porta quam</a></h5>
                                        <p class="price">$300,000</p>
                                        <a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27"  class="more">More Detail</a> </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-lg-4"><img src="images/properties/3.jpg"  class="img-responsive" alt="properties"/></div>
                                    <div class="col-lg-8">
                                        <h5><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Integer sed porta quam</a></h5>
                                        <p class="price">$300,000</p>
                                        <a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27"  class="more">More Detail</a> </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-lg-4"><img src="images/properties/4.jpg"  class="img-responsive" alt="properties"/></div>
                                    <div class="col-lg-8">
                                        <h5><a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27" >Integer sed porta quam</a></h5>
                                        <p class="price">$300,000</p>
                                        <a href="javascript:if(confirm(%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a path excluded by the site\%27s Robot Exclusion parameters.  (Teleport Pro\%27s compliance with this system is optional; see the Project Properties, Netiquette page.)  \n\nDo you want to open it from the server?%27))window.location=%27http://thebootstrapthemes.com/live/thebootstrapthemes-realestate/property-detail.php%27"  class="more">More Detail</a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="footer">

        <div class="container">



            <div class="row">
                <div class="col-lg-3 col-sm-3">
                    <h4>Information</h4>
                    <ul class="row">
                        <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about.html" >About</a></li>
                        <li class="col-lg-12 col-sm-12 col-xs-3"><a href="agents.html" >Agents</a></li>
                        <li class="col-lg-12 col-sm-12 col-xs-3"><a href="blog.html" >Blog</a></li>
                        <li class="col-lg-12 col-sm-12 col-xs-3"><a href="contact.html" >Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-sm-3">
                    <h4>Newsletter</h4>
                    <p>Get notified about the latest properties in our marketplace.</p>
                    <form class="form-inline" role="form">
                        <input type="text" placeholder="Enter Your email address" class="form-control">
                        <button class="btn btn-success" type="button">Notify Me!</button></form>
                </div>

                <div class="col-lg-3 col-sm-3">
                    <h4>Follow us</h4>
                    <a href="#"><img src="images/facebook.png"  alt="facebook"></a>
                    <a href="#"><img src="images/twitter.png"  alt="twitter"></a>
                    <a href="#"><img src="images/linkedin.png"  alt="linkedin"></a>
                    <a href="#"><img src="images/instagram.png"  alt="instagram"></a>
                </div>

                <div class="col-lg-3 col-sm-3">
                    <h4>Contact us</h4>
                    <p><b>Bootstrap Realestate Inc.</b><br>
                        <span class="glyphicon glyphicon-map-marker"></span> 8290 Walk Street, Australia <br>
                        <span class="glyphicon glyphicon-envelope"></span> hello@bootstrapreal.com<br>
                        <span class="glyphicon glyphicon-earphone"></span> (123) 456-7890</p>
                </div>
            </div>
            <p class="copyright">Copyright 2013. All rights reserved.	</p>
        </div>
    </div>
<!-- Modal -->
<div id="loginpop" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-sm-6 login">
                    <h4>Login</h4>
                    <form class="" role="form">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-success">Sign in</button>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <h4>New User Sign Up</h4>
                        <p>Join today and get updated with all the properties deal happening around.</p>
                        <button type="submit" class="btn btn-info"  onclick="window.location.href='register.html'">Join Now</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>