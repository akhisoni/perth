<?php

$site = new Site();
$sites = $site->getHomePageDataSection(1);
?>
<style>
    .footer a:hover {color:#fff; text-decoration: none;}
    .footer a {color:#cbd0d3; text-decoration: none;}
</style>
<footer>
    
    <div class="container-fluid footer">
        <div class="row text-white footer">
            <div class="col-sm-12">
            <div class="col-sm-3 footer-widget1">
                <h6><?php echo $sites['footer_about_title'];?></h6>
                <p><?php echo $sites['footer_about_desc'];?></p>
            </div>
            <div class="col-sm-3 footer-widget2">
                <h6 class="footerhead text-center">Newsletter</h6>
                <span style="color:#cbd0d3">Stay in touch with us on the latest new and events</span>
                <div class="text-center">
                    <form class="text-center">
                        <div class="form-group">
                            <div class="input-group">
                                <form name="news" method="post" action="index.php">
                                <input class="form-control" id="email" type="email" placeholder="Email" aria-label="Search">
                                <div class="input-group-addon">
                                  
                                    <button class="newslatterbtn" type="submit" name="submit"><i class="fas fa-paper-plane"></i></button>
                                </div>
                                    </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-3 footer-widget3">
                <h6 class="text-white wd3text">Information</h6>
                <div class="">
                    <ul class="footerlist">
                       <a href="<?php echo CreateLink(array("aboutus")); ?>"><li class="list-item">Privacy</li></a> 
                        <a href="#"> <li class="list-item">Terms & Conditions</li></a> 
                       <a href="#"> <li class="list-item">Sitemap</li></a> 
                        <a href="#"><li class="list-item">FAQ's</li></a> 
                        <a href="#"><li class="list-item">Another Page</li></a> 
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 footer-widget4">
                <h6 class="text-white wd3text">Contact Us</h6>
                <ul class="footerlist">
                    <?php if($sites['footer_cont']) {?>
                    <li>
                        <i class="fas fa-mobile-alt"></i><a href="tel:<?php echo $sites['footer_cont'];?>"><?php echo $sites['footer_cont'];?> </a>
                    </li>
                  <?php }?>
                    <?php if($sites['footer_add']) {?>
                    <li>
                        <i class="fas fa-map-marker-alt"></i><?php echo $sites['footer_add'];?>
                    </li>
                    <?php }?>
                     <?php if($sites['footer_add2']) {?>
                     <li>
                         <i class="fas fa-map-marker-alt"></i><?php echo $sites['footer_add2'];?>
                    </li>
                     <?php }?>
                    
                    <?php if($sites['footer_email']) {?>
                    <li><i class="fas fa-envelope-open-text"></i><a href="mailto:<?php echo $sites['footer_email'];?> "><?php echo $sites['footer_email'];?> </a>
                    </li>
                     <?php }?>
                </ul>
                <div class="container">
                    <ul class="list-inline text-white smicon">
                        <?php if($sites['footer_fb']) {?>
                        <li class="list-inline-item">
                            <a href="<?php echo $sites['footer_fb'];?>"><i class="fab fa-facebook" style="font-size: 25px;"></i></a>
                        </li>
                         <?php }?> <?php if($sites['footer_twt']) {?>
                        <li class="list-inline-item">
                            <a href="<?php echo $sites['footer_twt'];?>"><i class="fab fa-twitter" style="font-size: 25px;"></i></a>
                        </li><?php }?> <?php if($sites['footer_insta']) {?>
                        <li class="list-inline-item">
                            <a href="<?php echo $sites['footer_insta'];?>"><i class="fab fa-instagram" style="font-size: 25px;"></i></a>
                        </li> <?php }?><?php if($sites['footer_youtube']) {?>
                        <li class="list-inline-item">
                            <a href="<?php echo $sites['footer_youtube'];?>"><i class="fab fa-youtube" style="font-size: 25px;"></i></a>
                        </li><?php }?>
                         <?php if($sites['footer_link']) {?>
                          <li class="list-inline-item">
                              <a href="<?php echo $sites['footer_link'];?>"><i class="fab fa-linkedin" style="font-size: 25px;"></i></a>
                        </li><?php }?>
                    </ul>
                </div>
            </div>
                </div>
        </div>
    </div>
    <!--- This is a hover test-->
    <!-- Copyright Section -->
    <div class="bg-dark text-white copyrights">
        <p class="text-center text-white copyrighttext">Copyright @ 2019. ALL RIGHTS RESERVED | Powered By <a href="#">Maxlence</a></p>
    </div>
    
    </footer>