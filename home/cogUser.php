<?php
$chatDiv = '
<div class="chatWrapper">
    <div class="scrollerFlex">
        <div class="containerCozy">
            <div class="messageCozy">
                <div class="headerCozy">
                    <div class="avatarWrapper">
                        <img src="../common/img/profile.jpeg" class="circle chatUserProfile">
                    </div>
                    <div class="headerCozyName">'.@$foeUserRow['username'].'</div>
                    <time class="timestampCozy">'.@$chatRow['time'].'</time>
                </div>
                <div class="containerChatCozy">
                    <div class="contentCozy">
                        '.@$chatRow['text'].'
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divider"></div>
';
$userChatDiv = '
<div class="chatWrapper">
    <div class="scrollerFlex">
        <div class="containerCozy">
            <div class="messageCozy">
                <div class="headerCozy">
                    <div class="avatarWrapper">
                        <img src="../common/img/profile.jpeg" class="circle chatUserProfile">
                    </div>
                    <div class="headerCozyName">'.@$x['username'].'</div>
                    <time class="timestampCozy">'.@$chatRow['time'].'</time>
                </div>
                <div class="containerChatCozy">
                    <div class="contentCozy">
                        '.@$chatRow['text'].'
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divider"></div>
';
$emptyDiv = '
<div>mulai konfersasi dengan orang ini</div>
';
?>