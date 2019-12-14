<?php
    require_once "../database/db_user.php";

    $show = true;

    if(!isset($_GET['userID'])){
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die();
    }

    $profiledata = getUserDetailsProfile($_GET['userID']);
    
    echo $profiledata;
    
    if(sizeof($profiledata) <= 0){
        header("Location: " . $_SERVER['HTTP_REFERER']);
        echo "rip";
    }
    
    print_r($profiledata);
    $places = getOwnedPlaces($_GET['userID']);
    $isHost = (sizeof($places)>0);
    $hasReviews = False;
?>

<script>
let userID = <?php echo $_GET['userID'];?>
</script>

<?php if($isHost){ ?>

    <script src="../scripts/insertPlaces.js"></script>

<?php }
    if($show){
?>


<div class="wrapper">
    <div id="user-sidebar">
    <img id="profile_pic" src="../images/profile.png" alt="profile picture">

    <?php
            if($hasReviews){ ?>
    <img id="average_rating" src="../images/Average Rating.png" alt="rating">
    <p><?php echo $profiledata['firstName'] . "'s average rating"?></p>

    <?php
            } else{
                ?>
        <p><?php echo $profiledata['firstName'] . " has no reviews." ?></p>
    <?php
            }?> 
    
    </div>
    <div id="user">
        <section id="user-info">
            <h1><?php 
                echo $profiledata['firstName'] . " " . $profiledata['lastName'] ."   ";
                if($isHost) 
                    echo '<img id="host-badge" src="../images/host.png" height="20" width="50" alt="Host">';
            ?></h1>
            
            <p> Member since <?php echo gmdate("F d, Y") ?></p>
            <p><?php echo $profiledata['desc'];?> </p>
        </section>
        
        <?php
            if($isHost){ ?>
        <section id="user-places">
            <h3> My places </h3>
            <div id="places">
            </div>
        </section>
            <?php }?>
    </div>
</div>

<footer id="black-footer">

<?php } ?>