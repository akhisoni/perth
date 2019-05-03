<?php 
$help = new Help();
$helps = $help->ShowAllHelpFront();

?>

<div class="center-content">
<div class="contianer">
<div class="bredcram">
<div class="bred">
  <ul>
    <li> <a href="<?php echo SITEURL; ?>">Home</a></li>
    <li> /</li>
    <li>Help</a></li>
   
  </ul>
</div>
<div class="bred-inner">
  <h1>Help</h1>
  </div>
  
<div class="inner_content">

<?php foreach($helps as $helpss) { ?>
<button class="accordion"><?php echo $helpss['name']; ?></button>
<div class="panel">
  <p><?php echo $helpss['logn_desc']; ?></p>
</div>
<?php } ?>


  </div>
</div>
</div>






</div>

<style>
button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd;
}

div.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: 0.6s ease-in-out;
    opacity: 0;
}

div.panel.show {
    opacity: 1;
    max-height: 500px;  
}
</style>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}
</script>
