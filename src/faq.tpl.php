<?php
declare(strict_types = 1);
require_once(__DIR__ . '/database/faq.class.php');
?>


<?php function drawFAQs(array $faqs, string $role) { ?>
    <div class="faqlist">
        <?php foreach($faqs as $faq){?>
            <div class="faq">
            <p><span id="bold">Q: <?=$faq->title?></span></p>
            <p><span id="bold">A:</span> <?=$faq->content?></p>
        </div>
        <?php } ?>
    </div>
    
    <?php if($role != "client") { ?>
        <a href = "faq_config.php"><button class="new">+</button></a>
    <?php } ?>


<?php } ?>

<?php function drawFAQConfig(array $faqs){ ?>
    <label id="questionlabel">Question:</label>
    <form action = "action_create_faq.php" method = "post">
        <div class="userinput">
            <input type="text" name = "title">
            <input type="submit" value="Add">
        </div>

        <label id="answerlabel">Answer:</label>
        <div class="userinput" id="answerfaq">
            <input type="text" id="faqdesc" name = "content">
        </div>
    </form>

    <div class="faqlist" id="faqconfig">
    <?php foreach($faqs as $faq){ ?>
        <div class="faq">
            <p><span id="bold"><?=$faq->title?></span></p>
            <form action ="action_remove_faq.php?id=<?=$faq->id?>" method = "post">
                <button id="remove">X</button>
            </form>
        </div>
    <?php } ?>    

    </div>

</body>
<?php } ?>