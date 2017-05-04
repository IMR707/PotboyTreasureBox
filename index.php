
<html>

<head>
    <title>Cloone Templates</title>
    <!-- Custom Style frame.css -->
    <link rel="stylesheet" href="assets/iframe.css">
    <!-- jquery.min.js -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Frame.js  -->
    <script type="text/javascript" src="assets/iframe.js"></script>
    <!-- Google Font -->
    <link href='http://fonts.googleapis.com/css?family=Lato&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<script type="text/javascript">

// ReSize Frame Function
function ReSize(id,h,tb){
    var obj=document.getElementById(id);
    obj.style.width=h+'px';
    document.getElementById(tb).value='width: '+h+'px';

}

// Show Orignal Size Function (FullScreen)
function FullSize(id){
     var obj=document.getElementById(id);
     obj.style.width='100%';
     document.getElementById('TB1').value='width: 100%';

}

// Theme Switcher Function
function DropDown(el) {
    this.dd = el;
    this.placeholder = this.dd.children('span');
    this.opts = this.dd.find('ul.dropdown > li');
    this.val = '';
    this.index = -1;
    this.initEvents();
}
</script>
</head>
<body onLoad="ReSize('myframe',768,'TB1')">
    <!-- Center Content Tag -->
    <center>
        <iframe width="100%" height="100%" id="myframe" src="http://localhost/Potboy/index2.php">
        </frame>
    </center>
    <!-- End Center Content Tag -->
</body>

</html>
