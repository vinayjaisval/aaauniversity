<?php
$this->load->view('frontend/default/include/header');
$instructor_list = $this->crud_model->get_user()->result_array();

?>


<style>

    /* ===== MENU ===== */
    .menu {
        float: left;
        height: 700px;;
        width: 70px;
        background: #4768b5;
        background: -webkit-linear-gradient(#4768b5, #35488e);
        background: -o-linear-gradient(#4768b5, #35488e);
        background: -moz-linear-gradient(#4768b5, #35488e);
        background: linear-gradient(#4768b5, #35488e);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19);
    }

    .menu .items {
        list-style: none;
        margin: auto;
        padding: 0;
    }

    .discussions .discussion .message {
        margin: 0px 0 0 20px !important;
    }

    .menu .items .item {
        height: 70px;
        border-bottom: 1px solid #6780cc;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #9fb5ef;
        font-size: 17pt;
    }

    .menu .items .item-active {
        background-color: #5172c3;
        color: #FFF;
    }

    .menu .items .item:hover {
        cursor: pointer;
        background-color: #4f6ebd;
        color: #cfe5ff;
    }

    /* === CONVERSATIONS === */

    .discussions {
        width: 35%;
        height: 500px;
        box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.20);
        overflow: hidden;
        background-color: #87a3ec;
        display: inline-block;
    }

    .discussions .discussion {
        width: 100%;
        height: 90px;
        background-color: #FAFAFA;
        border-bottom: solid 1px #E0E0E0;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .discussions .search {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #E0E0E0;
    }

    .discussions .search .searchbar {
        height: 40px;
        background-color: #FFF;
        width: 70%;
        padding: 0 20px;
        border-radius: 50px;
        border: 1px solid #EEEEEE;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .discussions .search .searchbar input {
        margin-left: 15px;
        height: 38px;
        width: 100%;
        border: none;
        font-family: 'Montserrat', sans-serif;;
    }

    .discussions .search .searchbar *::-webkit-input-placeholder {
        color: #E0E0E0;
    }

    .discussions .search .searchbar input *:-moz-placeholder {
        color: #E0E0E0;
    }

    .discussions .search .searchbar input *::-moz-placeholder {
        color: #E0E0E0;
    }

    .discussions .search .searchbar input *:-ms-input-placeholder {
        color: #E0E0E0;
    }

    .discussions .message-active {
        width: 98.5%;
        height: 90px;
        background-color: #FFF;
        border-bottom: solid 1px #E0E0E0;
    }

    .discussions .discussion .photo {
        margin-left: 20px;
        display: block;
        width: 45px;
        height: 45px;
        background: #E6E7ED;
        -moz-border-radius: 50px;
        -webkit-border-radius: 50px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .online {
        position: relative;
        top: 30px;
        left: 35px;
        width: 13px;
        height: 13px;
        background-color: #8BC34A;
        border-radius: 13px;
        border: 3px solid #FAFAFA;
    }

    .discussions {
        width: 40% !important;
        background: #f6f6f6;
    }

    .desc-contact {
        height: 43px;
        width: 50%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .discussions .discussion .name {
        margin: 0 0 0 20px;
        font-family: 'Montserrat', sans-serif;
        font-size: 11pt;
        color: #515151;
    }

    .discussions .discussion .message {
        margin: 6px 0 0 20px;
        font-family: 'Montserrat', sans-serif;
        font-size: 9pt;
        color: #515151;
    }

    .timer {
        margin-left: 15%;
        font-family: 'Open Sans', sans-serif;
        font-size: 11px;
        padding: 3px 8px;
        color: #BBB;
        background-color: #FFF;
        border: 1px solid #E5E5E5;
        border-radius: 15px;
    }

    .chat {
        width: 709px !important;
        background: #bfbfbf1f;
        height: 500px;

    }

    .header-chat {
        background-color: #FFF;
        height: 90px;
        box-shadow: 0px 3px 2px rgba(0, 0, 0, 0.100);
        display: flex;
        align-items: center;
    }

    .chat .header-chat .icon {
        margin-left: 30px;
        color: #515151;
        font-size: 14pt;
    }

    .chat .header-chat .name {
        margin: 0 0 0 20px;
        text-transform: uppercase;
        font-family: 'Montserrat', sans-serif;
        font-size: 13pt;
        color: #515151;
    }

    .chat .header-chat .right {
        position: absolute;
        right: 40px;
    }

    .chat .messages-chat {
        padding: 25px 35px;
        min-height: 300px;
        max-height: 300px;
        overflow-y: scroll;
    }
    .chat .messages-chat::-webkit-scrollbar{
        width: 10px;
    }
    .chat .messages-chat::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    .chat .messages-chat::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    /* Handle */
    .chat .messages-chat::-webkit-scrollbar-thumb {
        background: #05256c;
        border-radius: 10px;
    }

    /* Handle on hover */
    .chat .messages-chat::-webkit-scrollbar-thumb:hover {
        background: #ff8de3;
    }



    .chat .messages-chat .message {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .chat .messages-chat .message .photo {
        display: block;
        width: 45px;
        height: 45px;
        background: #E6E7ED;
        -moz-border-radius: 50px;
        -webkit-border-radius: 50px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .chat .messages-chat .text {
        margin: 0 35px;
        background-color: #f6f6f6;
        padding: 15px;
        border-radius: 12px;
    }

    .text-only {
        margin-left: 45px;
    }

    .time {
        font-size: 10px;
        color: lightgrey;
        margin-bottom: 10px;
        margin-left: 85px;
    }

    .response-time {
        float: right;
        margin-right: 40px !important;
    }

    .response {
        float: right;
        margin-right: 0px !important;
        margin-left: auto; /* flexbox alignment rule */
    }

    .response_left {
        float: left;
        margin-right: auto;
        margin-left: 0px !important; /* flexbox alignment rule */
    }

    .response_left .text {
        background-color: #e3effd !important;
    }

    .message_time {
        float: right;
        margin-right: 50px;
        font-size: 10px;
        margin-top: -18px;
        background-color: #e3effd !important;

    }

    .response .text {
        background-color: #e3effd !important;
    }

    .footer-chat {
        width: calc(65% - 66px);
        height: 80px;
        display: flex;
        align-items: center;
        position: absolute;
        bottom: 0;
        background-color: transparent;
        border-top: 2px solid #EEE;

    }

    .chat .footer-chat .icon {
        margin-left: 30px;
        color: #C0C0C0;
        font-size: 14pt;
    }

    .chat .footer-chat .send {
        color: #fff;
        background-color: #4f6ebd;
        position: absolute;
        right: 50px;
        padding: 12px 12px 12px 12px;
        border-radius: 50px;
        font-size: 14pt;
    }

    .chat .footer-chat .name {
        margin: 0 0 0 20px;
        text-transform: uppercase;
        font-family: 'Montserrat', sans-serif;
        font-size: 13pt;
        color: #515151;
    }

    .chat .footer-chat .right {
        position: absolute;
        right: 40px;
    }

    .write-message {
        border: none !important;
        width: 74%;
        height: 50px;
        margin-left: 20px;
        padding: 10px;
    }

    .footer-chat *::-webkit-input-placeholder {
        color: #C0C0C0;
        font-size: 13pt;
    }

    .footer-chat input *:-moz-placeholder {
        color: #C0C0C0;
        font-size: 13pt;
    }

    .footer-chat input *::-moz-placeholder {
        color: #C0C0C0;
        font-size: 13pt;
        margin-left: 5px;
    }

    .footer-chat input *:-ms-input-placeholder {
        color: #C0C0C0;
        font-size: 13pt;
    }

    .clickable {
        cursor: pointer;
    }

    .footer-chat {
        position: relative;
        height: 53px;
        top: 15px;
        width: 100% !important;
    }

    .discussion_list {
        max-height: 390px;
        overflow-y: scroll;
        /*overflow-y: hidden*/
    }

    .discussion_list::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    .discussion_list::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    /* Handle */
    .discussion_list::-webkit-scrollbar-thumb {
        background: #05256c;
        border-radius: 10px;
    }

    /* Handle on hover */
    .discussion_list::-webkit-scrollbar-thumb:hover {
        background: #ff8de3;
    }

    .discussions .discussion .photo {
        margin-left: 20px;}

    .discussions .discussion .message {
        margin: 0px 0 0 1px !important;
    }
    .timer{
        text-align: center;
    }

    @media screen and (min-device-width: 300px) and (max-device-width: 608px) {
        .discussions{
            width: 100% !important;
        }
    }

</style>

<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">My Message </h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item active" aria-current="page">My Message</li>
            </ul>
        </div>
    </div>
    <ul class="shape-group">
        <li class="shape-1">
            <span></span>
        </li>
        <li class="shape-2 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-13.png')?>" alt="shape"></li>
        <li class="shape-3 scene"><img data-depth="-2" src="<?php echo base_url('uploads/system/images/about/shape-15.png')?>" alt="shape"></li>
        <li class="shape-4">
            <span></span>
        </li>
        <li class="shape-5 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-07.png')?>" alt="shape"></li>
    </ul>
</div>
<!--=====================================-->
<!--=        Blog Area Start            =-->
<!--=====================================-->


<div class="container">
    <div class="row">


        <section class="discussions">

            <div class="discussion search">
                <button class="edu-btn btn-medium" onclick="new_massage()" type="button">Compose <i class="icon-4"></i>
                </button>

            </div>
            <?php if (!isset($message_thread_code)): ?>
                <div class="text-center empty-box"><?php echo site_phrase('select_a_message_thread_to_read_it_here'); ?>
                    .
                </div>
            <?php endif; ?>

            <div class="discussion_list">
                <?php
                $current_user = $this->session->userdata('user_id');
                $this->db->where('sender', $current_user);

                /****** chanchal Code for latest chat show list*******/
                $this->db->order_by('message_thread_id', 'desc');

                $this->db->or_where('receiver', $current_user);
                $message_threads = $this->db->get('message_thread')->result_array();
                foreach ($message_threads as $row):

                    // defining the user to show
                    if ($row['sender'] == $current_user)
                        $user_to_show_id = $row['receiver'];
                    if ($row['receiver'] == $current_user)
                        $user_to_show_id = $row['sender'];

                    $last_messages_details = $this->crud_model->get_last_message_by_message_thread_code($row['message_thread_code'])->row_array();
                    ?>

                    <a class="discussion message"
                       href="<?php echo site_url('home/my_messages/read_message/' . $row['message_thread_code']); ?>">
                        <div class="discussion message <?php echo ($message_thread_code == $row['message_thread_code']) ? 'message-active' : '' ?>">
                            <div class="photo">
                                <img src="<?php echo $this->user_model->get_user_image_url($user_to_show_id); ?>">
                                <!--                        <div class="online"></div>-->
                            </div>
                            <div class="desc-contact">
                                <p class="name">
                                    <?php
                                    $user_to_show_details = $this->user_model->get_all_user($user_to_show_id)->row_array();
                                    echo $user_to_show_details['first_name'] . ' ' . $user_to_show_details['last_name'] . " ";
                                    ?></p>
                                <p class="message">
                                    <?php echo $last_messages_details['message'] . " " . $message_thread_code; ?>
                                </p>
                            </div>
                            <div class="timer">
                                <?php echo date('D, d-M-Y', $last_messages_details['timestamp']); ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

        </section>


        <section id="chat" class="chat">
            <?php
            if (isset($message_thread_code)):
                $message_thread_details = $this->db->get_where('message_thread', array('message_thread_code' => $message_thread_code))->row_array();
                if ($this->session->userdata('user_id') == $message_thread_details['sender']) {
                    $user_to_show_id = $message_thread_details['receiver'];
                } else {
                    $user_to_show_id = $message_thread_details['sender'];
                }
                $user_to_show_details = $this->user_model->get_all_user($user_to_show_id)->row_array();
                $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array(); ?>


                <div class="header-chat">
                    <i class="icon fa fa-user-o" aria-hidden="true"></i>
                    <p class="name">
                        <a href="<?php echo site_url('home/instructor_page'); ?>">
                        <span class="sender-info">
                        <span class="d-inline-block">
                            <img src="<?php echo $this->user_model->get_user_image_url($user_to_show_id); ?>"
                                 width="50pxs" alt="">
                        </span>
                        <span class="d-inline-block">
                            <?php echo $user_to_show_details['first_name'] . ' ' . $user_to_show_details['last_name']; ?>
                         </span>
                        </a>
                    </p>
                </div>


                <div id="chat_list" class="messages-chat">
                    <?php foreach ($messages as $message): ?>
                        <?php if ($message['sender'] == $this->session->userdata('user_id')): ?>

                            <div class="message ">
                                <div class="response">
                                    <p class="text"> <?php echo $message['message']; ?></p>
                                    <span class="message_time"><?php echo date('H:i:s A', $message['timestamp']); ?></span>
                                </div>
                            </div>
                        <?php else: ?>

                            <div class="message ">
                                <div class="response_left">
                                    <p class="text"> <?php echo $message['message']; ?></p>
                                    <span class="message_time">
                                        <?php echo date('H:i:s A', $message['timestamp']); ?>
                                     </span>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="footer-chat">
                    <form class=""
                          action="<?php echo site_url('home/my_messages/send_reply/' . $message_thread_code); ?>"
                          method="post">
                        <!--                        <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>-->

                        <div class="col-md-12 row">
                            <div class="col-1">

                            </div>
                            <div class="col-9">
                                <textarea type="text" name="message" class="text"
                                          style="min-height: 40px; padding-top: 5px !important; padding-bottom: 2px !important;"
                                          cols="100" rows="2"
                                          placeholder="Type your message here....." required></textarea>

                            </div>

                            <div class="col-2">
                                <button type="submit" class="edu-btn btn-small btn-secondary align-bottom">
                                    Send
                                </button>
                            </div>

                        </div>

                        <!--                        <i class="icon send fa fa-paper-plane-o clickable" aria-hidden="true"></i>-->
                    </form>
                </div>
            <?php endif;
            ?>
        </section>

        <section class="chat" style="display: none" id="new_chat">

            <div class="header-chat">
                <i class="icon fa fa-user-o" aria-hidden="true"></i>
                <p class="name">
                    <a href="<?php echo site_url('home/instructor_page'); ?>">
                        <span class="sender-info">
                        <span class="d-inline-block">
                            <img src="<?php echo $this->user_model->get_user_image_url($user_to_show_id); ?>"
                                 width="50pxs" alt="">
                        </span>
                        <span class="d-inline-block">
                            New Message
                         </span>
                    </a>
                </p>
            </div>

            <div>
                <form class="" action="<?php echo site_url('home/my_messages/send_new'); ?>" method="post">
                    <div>
                        <select name="receiver" style="background-color: #FFFFFF">
                            <?php foreach ($instructor_list as $instructor):
                                if ($instructor['id'] == $this->session->userdata('user_id'))
                                    continue;
                                ?>
                                <option value="<?php echo $instructor['id']; ?>"><?php echo $instructor['first_name'] . ' ' . $instructor['last_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div style="margin-top: 10px; resize: none">
                        <textarea type="text" name="message" placeholder="Write message here...."></textarea>
                    </div>
                    <br>
                    <button type="submit"
                            class="edu-btn btn-small btn-secondary"><?php echo site_phrase('send'); ?></button>
                    <button type="button" class="edu-btn btn-small bg-danger" onclick="CancelNewMessage()">Cancel
                    </button>
                </form>

            </div>
        </section>

    </div>
</div>
<br><br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    function new_massage() {
        $('#new_chat').show()
        $('#chat').hide()
    }

    function CancelNewMessage() {
        $('#new_chat').hide()
        $('#chat').show()
    }

    // $(document).ready(function () {
    //
    //     $(".chat").hide();
    //
    //
    // });
    //
    //
    // function h() {
    //     $(".chat").show();
    // }

    $(document).ready(function(){
        var height = document.getElementById("chat_list").scrollHeight;
        $(window).scrollTop(300,750);
        $('.messages-chat').scrollTop(height+10)
        console.log(height+10)

    });
</script>

<?php $this->load->view('frontend/default/include/footer'); ?>


