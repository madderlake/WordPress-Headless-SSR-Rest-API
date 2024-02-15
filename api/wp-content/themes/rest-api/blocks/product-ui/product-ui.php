<?php
/**
 * Product UI Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'prod-ui-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'product-ui';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$channel_name = get_field('channel_name') ?: 'Add Channel Here ...';

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
<div class="pui-header"></div>
    <div class="pui-sidebar medium-4 columns">
        <h4>Channels</h4>
        <?php $channel_obj = get_field_object('channel');?>
        <ul class="sidebar-list channels" data-ch="<?php echo $channel_obj['key']?>">
            <?php
            // check if the repeater field has rows of data
        if( have_rows('channel') ):

 	// loop through the channels
    $active_channel = '';
    while ( have_rows('channel') ) : the_row();

        $private = get_sub_field('private');
        $unread = get_sub_field('unread');
        $selected = get_sub_field('selected');
        $ch_class = "";

        $private ?  $ch_class = $ch_class . ' private'  : $ch_class;
        $unread ?  $ch_class = $ch_class . ' unread'  : $ch_class;
        $selected ?  $ch_class = $ch_class . ' selected'  : $ch_class;
        $active_channel = $selected ? get_sub_field('channel_name'): '';
        $sel_obj = get_sub_field_object("selected");


        ?>

        <li class="channel <?php echo $ch_class?>" data-sel="<?php echo  $selected ? 'true' : 'false' ?>"><span><?php the_sub_field('channel_name');?></span></li>
         <?php endwhile ?>

        <?php
        else :

            echo '<li class="channel">No channels found</li>';

        endif;
        ?>
        </ul>
         <h4>Direct Messages</h4>
        <ul class="sidebar-list direct-msgs">
            <li class="slackbot">Slackbot</li>
            <?php


     // check if the repeater field has rows of data
 	// loop through the member names
     if( have_rows('users') ):
     while ( have_rows('users') ) : the_row();
        $selected = get_sub_field('selected');
        $unread = get_sub_field('unread');
        $active = get_sub_field('active');
        $dm_class = '';

        $active ? $dm_class = $dm_class . ' active' : $dm_class;
        $selected ? $dm_class = $dm_class . ' selected' : $dm_class;
        $unread ?  $dm_class = $dm_class . ' unread'  : $dm_class;

        ?>

        <li class="dmsg <?php echo $dm_class?>"><?php the_sub_field('user_name');?></li>
         <?php endwhile ?>

        <?php
        else :

            echo '<li class="dmsg">No members found</li>';

        endif;
        ?>
        </ul>
    </div>
    <div class="pui-messages medium-8 columns">
        <div class="small-12 columns msg-header"><h5><?php echo $active_channel ? '#'.$active_channel: 'no selected channels'?></h5></div>
        <?php
        if( have_rows('message') ):
            while ( have_rows('message') ) : the_row();
            $avatar = get_sub_field('avatar');
            $avatar_img = $avatar['label'];
            //echo $avatar_img;
                switch($avatar['value']){
                    case 'Zoe':
                    $avatar_name = 'Zoe Maxwell';
                    break;

                    case 'Liza':
                    $avatar_name = 'Liza Dawson';
                    break;

                    case 'Sarah':
                    $avatar_name = 'Sarah Parker';
                    break;

                    case 'Lisa':
                    $avatar_name = 'Lisa Zhang';
                    break;

                    default:
                    $avatar_name = 'Select Avatar';

                }
            ?>
            <div class="message-wrapper">
                <div class="medium-2 columns avatar"><?php echo $avatar_img;?></div>
                <div class="medium-10 columns">
                    <span class="avatar-name"><?php echo $avatar_name ?></span><span class="msg-time"> <?php the_sub_field('time')?></span>
                    <?php the_sub_field('msg_content')?>
                </div>
            </div>
            <?php endwhile;
          else:
            echo "No messages Found";
          endif;
            ?>
    </div>
<!-- <div class="pui-footer"></div> -->
</div>
