<?php 
$objcontents=new PageCms();
if(isset($_POST["emailid"],$_POST["name"]))
{
	$objcontents->contactUs($_POST);
	$gotolink=CreateLink(array("contents","itemid"=>"thanks"));
	redirectUrl($gotolink);
}
$pages = $objcontents->GetPageData(1);
$contentdata=$objcontents->GetArticales($data["itemid"]);
$itfMeta=array("title"=>$contentdata["pagetitle"],"description"=>$contentdata["pagemetatag"],"keyword"=>$contentdata["pagekeywords"]);
$page = new PageCms();

$pages1 = $page->GetPageData(2);

?>
<div class="inner_page page_title">
<div class="span12 pgtitle">
<h1><span>Privacy Policy</span></h1>
</div>
</div>
 <div class="page-content">
            <div class="container">

<h6>Introduction</h6>

<ul>
<li>Our commitment is solely towards the protection of the website visitor privacy so that there is no leakage in confidentiality. In this privacy policy guidelines, we will be narrating how the personal information of all the clients will be handled by us.</li>
<li>Our first initiative will be to ask the clients to affirm the use of cookies on the website to abide by the website and application policies. By agreeing to it, you actually put your guard up against any possible threats by making use of cookies according to the terms of the policy.</li>
<li>We will not be gathering any private information until and unless you willingly give it to us.</li>
</ul>

<h6>Collection of Personal Information</h6>

<ul>
<li>Yes, we would be collecting some of the important information which is part generic and part personal in nature as follows:</li>
</ul>
<ol>
<li>Information about the kind of devices that you use, your IP address, browser version and category, operating system, page traffic, website navigation, etc.</li>
<li>When you register with us, you will be providing us with the aforementioned information along with some basic details like user ID and email id.</li>
<li>Next, you would have to fill in some other basic credentials like the profile picture, date of birth, relationship status, interests, hobbies, employment type, etc.</li>
<li>Information that is needed for an email</li>
<li>Information that you have to input while buying anything on the platform like your bank details.</li>
<li>Any communicative information that is being sent to and fro the website or the mobile application.</li>
<li>Any other information that you feel like sharing with us.</li>
</ol>
<ul>
<li>Before you share any other information with us regarding any other person, you will have to need the consent of the other person and abide by the privacy policy.</li>
</ul>

<h6>When will we use your Personal Information?</h6>
<ul>
<li>In the website policy, there are a number of reasons why your personal information can be shared.</li>
</ul>
<ul>
<li>Your personal information can be used for the following listed purposes:</li>
</ul>
<ol>
<li>Administering the website as well as the mobile information and branding of the business.</li>
<li>Customizing and tailoring the application for your needs</li>
<li>Enhancing the services available on the website and the application</li>
<li>Sending offers and goodies with the website and mobile application</li>
<li>Giving you the list of services of the products and services</li>
<li>Send overstatements and invoices to you so that you can get your payment reminders.</li>
<li>Nonmarketing strategy communication</li>
<li>For your special email notification that the user has requested to us</li>
<li>All email newsletters, which can be stopped anytime you want</li>
<li>Your information will be needed to get the marketing and branding communications so that you can avail all the offers of our brand as well as the third party which might seem relevant to you- and this also can be stopped anytime you want.</li>
<li>Providing the third parties with your information but keeping your individual identities confined to us.</li>
<li>Dealing with the queries and solving the complaints of the users.</li>
<li>Prevention of fraudulent activities.</li>
</ol>
<p style="margin-left: .5in;">&nbsp;</h6>
<ul>
<li>When you submit the personal information on the website or the application, then we will ask you for consent and only after your affirmation, it will be published.</li>
<li>The settings of your privacy can be customized so that you can limit the extent of information that is to be published, and you can adjust it in accordance to your needs.</li>
<li>Without your consent, no third party will be getting your personal information no matter what the cause is.</li>
<li>All the monetary transactions of the website are done through trusted servers so that you do not have to worry about the online transactions in any manner. Your refunds and billing will be done just like you want and without any leakage of your confidential information.</li>
</ul>

<h6>Disclosure of information</h6>
<ul>
<li>The information can be disclosed to any of our core company members like employees, marketing experts, professionals, who are a part of our team. But measures will be taken so that it remains inside the team only.</li>
<li>Our disclosure may be reaching the levels of our subsidiaries and our entire company unit since your services are not confined to just one department.</li>
<li>The disclosure will occur in the following manner:</li>
</ul>
<ol>
<li>To the extent, we are allowed to disclose as per law</li>
<li>With the help of any legal proceeding,</li>
<li>For the defense of our legal rights so that fraudulent activity can be restrained.</li>
<li>For any particular business deal, buying or selling any product or services.</li>
<li>For any individual who might seek help from the court for disclosure of their personal information.</li>
</ol>
<ul>
<li>Apart from the aforementioned policies, the disclosure will not happen to any of the third parties.</li>
</ul>

<h6>International Data transfer</h6>
<ul>
<li>We operate in various countries, therefore the information might be transferred from one nation to another so that the information can be used perfectly.</li>
</ul>
<p style="margin-left: .5in;">The information can be transferred to the countries namely- USA, Russia, Japan, China, and India.</h6>
<ul>
<li>The Information that you wish to publish might be available to all parts of the world via the internet.</li>
<li>It can be transferred if you have agreed to the personal information transfer.</li>
</ul>

<h6><strong>Retention of Personal Information</strong></h6>

<ul>
<li>In this section, we will be talking mostly about the retention of data and the policies that are installed in this segment so that all the legal restrictions are abided by.</li>
<li>Any personal information will not be retained beyond the necessary time frame and will not be used for any unwanted activities.</li>
<li>According to the policies, the data will be retained as per the following system:</li>
</ul>
<ol>
<li>It will be retained as per legal boundaries</li>
<li>Relevant information will be retained only</li>
<li>Retention for the defense of the legal rights of the company and the elimination of fraudulent activity or even credit risk.</li>
</ol>

<h6>Security of the Personal Information</h6>

<ul>
<li>Every aspect of the information will be taken care of in manners- both technical and organizational so that no misuse can occur.</li>
<li>All the information is stored in the dual walled password protected as well as firewall protected servers so that there is no loss of information.</li>
<li>All transactions will be encrypted to the fullest.</li>
<li>The internet publication of your information is done on your consent, and once it is done, we will have no responsibility for the same.</li>
<li>The password is yours to use and we will not be asking for the password anytime except when you are logging on to your website.</li>
</ul>

<h6>Amendments</h6>
<ul>
<li>This policy can get updated time to time on the website or mobile application</li>
<li>You should keep a check on this page from time to time to remain updated</li>
<li>We might give you email notifications via email.</li>
</ul>

<h6>What are your rights to the privacy policy?</h6>

<ul>
<li>You will be able to command us regarding the disclosure</li>
<li>In case of any personal information that we hold and that can be done in the following cases:</li>
</ul>
<ol>
<li>Payment or monetary transaction</li>
<li>Your identity that it is you who is asking for the credentials by producing your passport affirmed by a solicitor or even your utility bill showing your current address.</li>
</ol>
<ul>
<li>You will be able to retain any personal information as per given by law.</li>
<li>You may command us against disclosing or publishing your personal information or identity including marketing purpose and it will be done. You can adjust the extent of command that you want to have over your information and it will be brought forth.</li>
</ul>

<h6>Third Party websites and applications</h6>

<ul>
<li>Our website will invariably comprise the hyperlinks to the third party websites and other applications.</li>
<li>The privacy policy of the third party is a separate thing altogether and we have no responsibility about the same.</li>
</ul>

<h6>Updating Information</h6>

<ul>
<li>If you need to correct any personal information that we possess about you, please make sure that the word reaches us so that we can make the necessary changes.</li>
</ul>

<h6>Cookie Usage</h6>

<ul>
<li>We make use of cookies on our website</li>
<li>In case you do not know what it is, a cookie is a sort of identification that is sent by the server to a browser and gets stores in there so that the user can be recognized the time and again.</li>
<li>There are two types of cookies- persistent and session. While the former one has to be used by the user and then deleted after he or she is done, the session cookie gets auto-deleted after a given time frame.</li>
<li>The cookies in itself do not carry any personal information, but your personal info might be linked to the identifier to some extent.</li>
<li>The purpose of the cookies are being listed below as follows:</li>
</ul>
<ol>
<li>Recognizing the computer or the user</li>
<li>Enabling the usage of the shopping cart</li>
<li>Enhancing usability</li>
<li>Improving search engine result option</li>
</ol>
<ul>
<li>Many browsers will not accept the use of cookies</li>
<li>Blocking cookies might bring adverse effects on the browser</li>
<li>Blocking cookies might not let you explore the entire website.</li>
<li>You can delete cookies anytime you like.</li>
</ul>

<h6>Other Identifying techniques</h6>

<p>Other techniques can be used for the website and the mobile application to determine the kind of operating system, browser, and websites that you have used, and a lot more.</p>

<h6>Personal Information protection policy</h6>
<p>Our company will be protecting all the information that you have disclosed to us as per the laws of India.</p>

<h6>Updating the personal data</h6>
<p>If you have any requests regard the correction of data or updating of the same then we will help you in the best possible manner. You can contact us at Creaseart official mail id.</p>

            </div>
           
            
            </div>
<style>
h6 { line-height:35px; font-weight:bold;}
</style>     