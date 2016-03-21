<?php
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/news']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="spacer blog">
        <div class="row">
            <div class="col-lg-8">

                <!-- blog detail -->
                <h2>Creative business to takeover the market</h2>
                <div class="info">Posted on: Jan 20, 2013</div>
                <img src="images/blog/1.jpg"  class="thumbnail img-responsive"  alt="blog title">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <!-- blog detail -->




            </div>
            <div class="col-lg-4 visible-lg">

                <!-- tabs -->
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#tab1" data-toggle="tab">Recent Post</a></li>
                        <li class=""><a href="#tab2" data-toggle="tab">Most Popular</a></li>
                        <li class="active"><a href="#tab3" data-toggle="tab">Most Commented</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <ul class="list-unstyled">
                                <li>
                                    <h5><a href="blogdetail.html" >Real estate marketing growing</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>
                                <li>
                                    <h5><a href="blogdetail.html" >Real estate marketing growing</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>
                                <li>
                                    <h5><a href="blogdetail.html" >Real estate marketing growing</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <ul  class="list-unstyled">
                                <li>
                                    <h5><a href="blogdetail.html" >Market update on new apartments</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>

                                <li>
                                    <h5><a href="blogdetail.html" >Market update on new apartments</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>

                                <li>
                                    <h5><a href="blogdetail.html" >Market update on new apartments</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane active" id="tab3">
                            <ul class="list-unstyled">
                                <li>
                                    <h5><a href="blogdetail.html" >Creative business to takeover the market</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>

                                <li>
                                    <h5><a href="blogdetail.html" >Creative business to takeover the market</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>
                            </ul>
                        </div>
                    </div>



                </div>
                <!-- tabs -->


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


    </div></div>




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