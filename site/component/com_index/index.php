<?php 
$page = new PageCms();
$pages = $page->GetPageData(1);
$pages1 = $page->GetPageData(2);
$pages2 = $page->GetPageData(7);
$pages3 = $page->GetPageData(3);
$pages4 = $page->GetPageData(4);

$testim = new Testimonial();
$testi = $testim->showTestimonialbyFront();

$banner = new WebsiteBanner();
$bannerlist = $banner->getAllBannerFront();


$events = new Events();
$eventlist = $events->ShowAllProductFrontend();


$news = new News();
$newslist = $news->ShowAllNewsFront();

function limit_words($string, $word_limit) {
	$string = strip_tags($string);
	$words = explode(' ', strip_tags($string));
	$return = trim(implode(' ', array_slice($words, 0, $word_limit)));
	if(strlen($return) < strlen($string)){
	$return .= '...';
	}
	return $return;
}
?>

<section>
         <div>
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                
                <?php foreach($bannerlist as $bannerlist1) {?>
                
                <div class="carousel-item <?php echo $bannerlist1['class']; ?>">
                    <img src="<?php echo PUBLICPATH."website_banner/".$bannerlist1['imagename']; ?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption text-dark">
                        <h3>Welcome to Perth Tango Society </h3>
                        <hr>
                        <p>WE ORGANISE ARGENTINE TANGO EVENTS, FESTIVALS, CLASSES <br> AND WORKSHOPS IN PERTH</p>
                        <div class="eventbutton">
                             <a href="#" class="section2btn">Event Calender</a>
                            
                        </div>
                    </div>
                </div>
                
              <?php  }?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- Section 1 Carousel Home End-->
    <!-- Section 2 Banner Start-->
    <div class="banner">
        <img src="<?php echo TemplateUrl();?>images/sec2.png" alt="Snow" style="width:100%;">
        <div class="bottom-left">
        </div>
        <div class="top-right">
            <div class="">
                <h4 class="">LEADING TO THE DANCE OF HEART...</h4>
                <img class="hrimg" src="<?php echo TemplateUrl();?>images/hrline_white.png">
                <div class="abouttext">
                <h6>WE ORGANISE ARGENTINE TANGO EVENTS, FESTIVALS, <br />CLASSES AND WORKSHOPS IN PERTH</h6></div>
                <a href="#" class="section2btn">Read more About Us</a>
            </div>
        </div>
    </div>
    <!-- Section 2 Banner End -->
    <!--  Anoucemnet Tabs Start -->
    <div class="">
        <div class="announcement bg-danger text-center text-white">
            <p><i class="fas fa-bullhorn"></i>Join Tango Classes - “Come try!! You’re first class is free”</p>
        </div>
    </div>
    <!---- Anoucemnet Tabs End -->
    <!--------------------------  Upcoming Events  --------------------------->
    <div class="event_section">
        
        <div class="event_section">
            <h4 class="text-center sectionhead3">Upcoming Events</h4>
            <div class="hrline test_center">
                <hr>
            </div>
            
            </div>
            <div class="container">
                <div class="card-deck">
                    <?php foreach($eventlist as $eventlist1){ ?>
                    <div class="card" style="box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.16);">
                        <div class="eventimg">
                          <a href="#">  
                              <img class="card-img-top" src="<?php echo PUBLICPATH."events/".$eventlist1['main_image']; ?>" alt="Card image cap" /></a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="#"><?php echo $eventlist1['event_name']; ?></a></h5>
                           <span><i class="fas fa-user-friends"></i><?php echo $eventlist1['event_name']; ?></span> 
                            
                            <div class="row">
                                <div class="col">
                                    <span><i class="far fa-calendar-alt"></i> <?php echo $eventlist1['start_date']; ?></span>
                                </div>
                                <div class="col">
                                     <span><i class="fas fa-clock"></i><?php echo $eventlist1['start_time']; ?></span></div>
                            </div>
                            <span><i class="fas fa-map-marker-alt"></i>211 <?php echo $eventlist1['address']; ?></span>
                        </div>
                    </div>
                    <?php } ?>
                   
                    
                    
                    
                    
                </div>
                <div class="text-center viewmoreevent">
                   <a href="#" class="section2btn">View More About Events</a>
                </div>
            </div>
        
    </div>
    <!--------------------------  Upcoming Events Section Event --------------------------->
    <!--------------------------  Classes Section Start --------------------------->
    <div class="classsec">
        <h4 class="text-center text-white sectionhead3">Classes</h4>
        <div class="">
            <div class="text-center hrimg">
                <img src="<?php echo TemplateUrl();?>images/hrline_white.png">
            </div>
            <div>
            </div>
            <div class="container">
                
                
                <div class="card-deck">
                    <div class="card" style="box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.16);">
                        <img class="card-img-top" src="<?php echo TemplateUrl();?>images/dance.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Name of The Class</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi maximus, magna a mattis dapibus, </p>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo TemplateUrl();?>images/dance.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Name of The Class</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi maximus, magna a mattis dapibus, </p>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo TemplateUrl();?>images/dance.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Name of The Class</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi maximus, magna a mattis dapibus, </p>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo TemplateUrl();?>images/dance.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Name of The Class</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi maximus, magna a mattis dapibus, </p>
                        </div>
                    </div>
                </div>
                <div class="text-center viewmoreclass">
                    <a href="#" class="section2btn">View More About Classes</a>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------  Classes Section End --------------------------->
    <div class="newsandarticles">
        <h4 class="text-center sectionhead3">RECENT NEWS & ARTICLES</h4>
        <div class="">
            <div class="hrline">
                <hr>
            </div>
            <div>
            </div>
            <div class="container">
                <div class="card-deck">
                    
                    <?php foreach($newslist as $newslist1){ ?>
                    
                    <div class="card" style="box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.16);">
                        <a href="#"><img class="card-img-top" src="<?php echo PUBLICPATH."newsimage/".$newslist1['newsimage']; ?>" alt="Card image cap"></a>
                        <div class="card-body">
                            <div class="card-title"><?php echo $newslist1['pagetitle']; ?></div>
                           <div class="card-text"><?php echo limit_words($newslist1['description'], 30); ?></div>
                            <span class="clnewsdate"><i class="fas fa-clock text-muted"></i>
                            <?php 
                                $date = date($newslist1['entrydate'], strtotime('-22 hour'));
echo $date;
                                
                                ?>
                            </span>
                        </div>
                    </div>
                    
                    <?php } ?>
                </div>
                <div class="text-center viewmorenews">
                    <a href="#" class="section2btn">Past News & Articles</a>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------  News Section End --------------------------->
    <!-- Gallrey Section -->
    <div class="gallreysec">
        <div class="gallrey container-fluid">
            <h2 class="text-center text-white sectionhead3">Gallrey</h2>
            <div class="text-center">
                <img src="<?php echo TemplateUrl();?>images/hrline_white.png">
            </div> <br/>
            <div class="row">
                
                <div class="galdiv col-md-3">
                    
                  <a href="#">  <img class="img1" src="<?php echo TemplateUrl();?>images/gallery2.jpeg">
                    <div class="overlay overlayBottom">
                         <div class="card-title"> This is a text</div>
                        <div class="card-text"> Loreum ispuem semet dolor, loreuem ispuem semet dolor</div>
                    </div></a>
                </div>
               <div class="galdiv col-md-3">
                  <a href="#">  <img class="img1" src="<?php echo TemplateUrl();?>images/gallery1.jpeg">
                    <div class="overlay overlayBottom">
                         <div class="card-title"> This is a text</div>
                        <div class="card-text"> Loreum ispuem semet dolor, loreuem ispuem semet dolor</div>
                    </div></a>
                </div>
                <div class="galdiv col-md-3">
                  <a href="#">  <img class="img1" src="<?php echo TemplateUrl();?>images/gallery2.jpeg">
                    <div class="overlay overlayBottom">
                         <div class="card-title"> This is a text</div>
                        <div class="card-text"> Loreum ispuem semet dolor, loreuem ispuem semet dolor</div>
                    </div></a>
                </div>
               <div class="galdiv col-md-3">
                  <a href="#">  <img class="img1" src="<?php echo TemplateUrl();?>images/gallery1.jpeg">
                   <div class="overlay overlayBottom">
                         <div class="card-title"> This is a text</div>
                        <div class="card-text"> Loreum ispuem semet dolor, loreuem ispuem semet dolor</div>
                    </div></a>
                </div>
            </div>
            <div class="row">
               <div class="galdiv col-md-3">
                  <a href="#">  <img class="img1" src="<?php echo TemplateUrl();?>images/gallery1.jpeg">
                    <div class="overlay overlayBottom">
                         <div class="card-title"> This is a text</div>
                        <div class="card-text"> Loreum ispuem semet dolor, loreuem ispuem semet dolor</div>
                    </div></a>
                </div>
               <div class="galdiv col-md-3">
                 <a href="#">  <img class="img1" src="<?php echo TemplateUrl();?>images/gallery2.jpeg">
                    <div class="overlay overlayBottom">
                         <div class="card-title"> This is a text</div>
                        <div class="card-text"> Loreum ispuem semet dolor, loreuem ispuem semet dolor</div>
                    </div></a>
                </div>
                <div class="galdiv col-md-3">
                  <a href="#">  <img class="img1" src="<?php echo TemplateUrl();?>images/gallery1.jpeg">
                    <div class="overlay overlayBottom">
                         <div class="card-title"> This is a text</div>
                        <div class="card-text"> Loreum ispuem semet dolor, loreuem ispuem semet dolor</div>
                    </div></a>
                </div>
                <div class="galdiv col-md-3">
                 <a href="#">  <img class="img1" src="<?php echo TemplateUrl();?>images/gallery2.jpeg">
                    <div class="overlay overlayBottom">
                         <div class="card-title"> This is a text</div>
                        <div class="card-text"> Loreum ispuem semet dolor, loreuem ispuem semet dolor</div>
                    </div></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallrey Section End-->
    <!-- Music Section -->
    <div class="musicalbum">
        <h4 class="text-center sectionhead3">Music</h4>
        <div class="">
            <div class="hrline">
                <hr>
            </div>
            <div class="container">
                <div class="card-deck text-white">
                    <div class="card stretched-link" style="box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.16);">
                        <img class="card-img-top" src="<?php echo TemplateUrl();?>images/music1.png" alt="Card image cap">
                        <div class="card-body musiccard">
                             <div class="card-title">Music Album Name</div>
                             <div class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi maximus, magna a mattis dapibus,</div>
                            <div class="musicbtndiv">
                                <a href="#" class="musicbtn">View Album</a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo TemplateUrl();?>images/music2.png" alt="Card image cap">
                        <div class="card-body musiccard">
                            <div class="card-title">Music Album Name</div>
                             <div class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi maximus, magna a mattis dapibus,</div>
                            <div class="musicbtndiv">
                              <a href="#" class="musicbtn">View Album</a>
                            </div>
                        </div>
                    </div>
                    <div class="card text-white">
                        <img class="card-img-top" src="<?php echo TemplateUrl();?>images/music1.png" alt="Card image cap">
                        <div class="card-body musiccard">
                            <div class="card-title">Music Album Name</div>
                             <div class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi maximus, magna a mattis dapibus,</div>
                            <div class="musicbtndiv">
                                <a href="#" class="musicbtn">View Album</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo TemplateUrl();?>images/music2.png" alt="Card image cap">
                        <div class="card-body musiccard">
                            <div class="card-title">Music Album Name</div>
                             <div class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi maximus, magna a mattis dapibus,</div>
                            <div class="musicbtndiv">
                                <a href="#" class="musicbtn">View Album</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="<?php echo TemplateUrl();?>images/music2.png" alt="Card image cap">
                        <div class="card-body musiccard">
                            <div class="card-title">Music Album Name</div>
                             <div class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi maximus, magna a mattis dapibus,</div>
                            <div class="musicbtndiv">
                                 <a href="#" class="musicbtn">View Album</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
   </section>