<?php 
    $subjects = $db->select_subjects();
?>

<div class="uk-flex-top" id="modal-report" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 class="uk-modal-title">Send Report</h2>
        <form class="uk-form-stacked" action="../function/reports.php" method="post" enctype="multipart/form-data" id="reportForm">
            <div class="uk-margin">
                <div class="uk-form-label">Subject</div>
                <div class="uk-form-controls">
                    <select name="sub" required class="js-select">
                        <option value="">Select Subject</option>
                        <?php foreach($subjects as $subject): ?>
                        <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-form-label">Details</div>
                <div class="uk-form-controls">
                    <textarea name="details" required class="uk-textarea" placeholder="Try to include all details..."></textarea>
                </div>
                <div class="uk-form-controls uk-margin-small-top">
                    <div data-uk-form-custom>
                        <input name="file" required type="file">
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            <i class="ico_attach-circle"></i><span>Attach File</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-grid uk-flex-right fl-form-action" data-uk-grid>
                    <div><button class="uk-button uk-button-small uk-button-link" type="button">Cancel</button></div>
                    <div><button class="uk-button uk-button-small uk-button-danger" type="submit">Submit</button></div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="uk-flex-top" id="modal-help" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 class="uk-modal-title">Help</h2>
        <div class="search">
            <div class="search__input">
                <i class="ico_search"></i>
                <input type="search" name="search" placeholder="Search">
            </div>
        </div>
        <div class="uk-margin-small-left uk-margin-small-bottom uk-margin-medium-top">
            <h4>Popular Q&A</h4>
            <ul>
                <li><img src="../assets/img/svgico/clipboard-text.svg" alt="icon"><span>How to Upload Your Developed Game</span></li>
                <li><img src="../assets/img/svgico/clipboard-text.svg" alt="icon"><span>How to Go Live Stream</span></li>
                <li><img src="../assets/img/svgico/clipboard-text.svg" alt="icon"><span>Get in touch with the Creator Support Team</span></li>
            </ul>
            <ul>
                <li><a href="10_game-profile.html">browse all articles</a></li>
            </ul>
        </div>
    </div>
</div>
