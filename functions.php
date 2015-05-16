<?php
/*** 注册菜单 ***/
register_nav_menu( 'main-menu', 'Main Menu' );

/*** 特色图像 ***/
add_theme_support( 'post-thumbnails' );

/*** 图像大小 ***/
add_action( 'after_setup_theme', 'change_img_size' );
function change_img_size() {
  add_image_size( 'slider-thumb', 1170 , 400 ,true ); // 设置首页Slider的图片大小
  update_option( 'thumbnail_size_w', 560 );
  update_option( 'thumbnail_size_h', 315 );
  update_option( 'thumbnail_crop', 1 );
}
/*** 修改默认jquery版本 ***/
function add_scripts() { 
  wp_deregister_script( 'jquery' ); 
  wp_register_script( 'jquery', 'http://libs.baidu.com/jquery/1.11.1/jquery.min.js'); //9
  wp_enqueue_script( 'jquery' ); 
}

add_action('wp_enqueue_scripts', 'add_scripts');

/*** 修改默认Avatar样式 ***/
add_filter('get_avatar', 'avatar_class');
function avatar_class($class) {
  $class = str_replace("class='avatar", "class='avatar img-circle media-object", $class);
  return $class;
}

/*** Bootstrap Breadcrumb ***/
if (!function_exists("bootstrap_breadcrumb")):
  function bootstrap_breadcrumb() {

    $delimiter = ' <i class="fa fa-angle-right"></i> ';
    $name = '<li><a href="/">首页</a></li>'; //text for the 'Home' link
    $currentBefore = '<li class="active">';
    $currentAfter = '</li>';
   
    if ( !is_home() && !is_front_page() || is_paged() ) {
   
      echo '<ul class="breadcrumb">';
   
      global $post;
      $home = get_bloginfo('url');
      echo '' . $name . ' ' . $delimiter . ' ';
   
      if ( is_category() ) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $currentBefore . '';
        single_cat_title();
        echo '' . $currentAfter;
   
      } elseif ( is_day() ) {
        echo '' . get_the_time('Y') . ' ' . $delimiter . ' ';
        echo '' . get_the_time('F') . ' ' . $delimiter . ' ';
        echo $currentBefore . get_the_time('d') . $currentAfter;
   
      } elseif ( is_month() ) {
        echo '' . get_the_time('Y') . ' ' . $delimiter . ' ';
        echo $currentBefore . get_the_time('F') . $currentAfter;
   
      } elseif ( is_year() ) {
        echo $currentBefore . get_the_time('Y') . $currentAfter;
   
      } elseif ( is_single() ) {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $currentBefore;
        the_title();
        echo $currentAfter;
   
      } elseif ( is_page() && !$post->post_parent ) {
        echo $currentBefore;
        the_title();
        echo $currentAfter;
   
      } elseif ( is_page() && $post->post_parent ) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          $breadcrumbs[] = '' . get_the_title($page->ID) . '';
          $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
        echo $currentBefore;
        the_title();
        echo $currentAfter;
   
      } elseif ( is_search() ) {
        echo $currentBefore . '&#39;' . get_search_query() . '&#39;的搜索结果：' . $currentAfter;
   
      } elseif ( is_tag() ) {
        echo $currentBefore . 'Posts tagged &#39;';
        single_tag_title();
        echo '&#39;' . $currentAfter;
   
      } elseif ( is_author() ) {
         global $author;
        $userdata = get_userdata($author);
        echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
   
      } elseif ( is_404() ) {
        echo $currentBefore . 'Error 404' . $currentAfter;
      }
   
      if ( get_query_var('paged') ) {
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
        echo __('Page') . ' ' . get_query_var('paged');
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
      }
   
      echo '</ul>';
   
    }
  }
endif;


/*** Bootstrap Nav Menu ***/
class Glen_Nav_Menu extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = array() ) {   
        $indent = str_repeat( "\t", $depth );   
        $output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";   
    }   
  
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {   
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';   

        if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {   
            $output .= $indent . '<li role="presentation" class="divider">';   
        } else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {   
            $output .= $indent . '<li role="presentation" class="divider">';   
        } else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {   
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );   
        } else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {   
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';   
        } else {   
  
            $class_names = $value = '';   
  
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;   
            $classes[] = 'menu-item-' . $item->ID;   
  
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );   
  
            if ( $args->has_children )   
                $class_names .= ' dropdown';   
  
            if ( in_array( 'current-menu-item', $classes ) )   
                $class_names .= ' active';   
  
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';   
  
            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );   
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';   
  
            $output .= $indent . '<li' . $id . $value . $class_names .'>';   
  
            $atts = array();   
            $atts['title']  = ! empty( $item->title )   ? $item->title  : '';   
            $atts['target'] = ! empty( $item->target )  ? $item->target : '';   
            $atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';   
  
            // If item has_children add atts to a.   
            if ( $args->has_children && $depth === 0 ) {   
                $atts['href']           = '#';   
                $atts['data-toggle']    = 'dropdown';   
                $atts['class']          = 'dropdown-toggle';   
                $atts['aria-haspopup']  = 'true';   
            } else {   
                $atts['href'] = ! empty( $item->url ) ? $item->url : '';   
            }   
  
            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );   
  
            $attributes = '';   
            foreach ( $atts as $attr => $value ) {   
                if ( ! empty( $value ) ) {   
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );   
                    $attributes .= ' ' . $attr . '="' . $value . '"';   
                }   
            }   
  
            $item_output = $args->before;   

            if ( ! empty( $item->attr_title ) )   
                $item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';   
            else  
                $item_output .= '<a'. $attributes .'>';   
  
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;   
            $item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';   
            $item_output .= $args->after;   
  
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );   
        }   
    }   
  
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {   
        if ( ! $element )   
            return;   
  
        $id_field = $this->db_fields['id'];   
  
        // Display this element.   
        if ( is_object( $args[0] ) )   
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );  
         
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }   
 
    public static function fallback( $args ) {   
        if ( current_user_can( 'manage_options' ) ) {   
  
            extract( $args );   
  
            $fb_output = null;   
  
            if ( $container ) {   
                $fb_output = '<' . $container;   
  
                if ( $container_id )   
                    $fb_output .= ' id="' . $container_id . '"';   
  
                if ( $container_class )   
                    $fb_output .= ' class="' . $container_class . '"';   
  
                $fb_output .= '>';   
            }   
  
            $fb_output .= '<ul';   
  
            if ( $menu_id )   
                $fb_output .= ' id="' . $menu_id . '"';   
  
            if ( $menu_class )   
                $fb_output .= ' class="' . $menu_class . '"';   
  
            $fb_output .= '>';   
            $fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>'; 
            $fb_output .= '</ul>';   
  
            if ( $container )   
                $fb_output .= '</' . $container . '>';   
  
            echo $fb_output;   
        }   
    }   
}


/*** 相关文章 ***/
if (!function_exists("related_posts")):
  function related_posts(){
    wp_reset_query();
    global $post;
    $cat = wp_get_post_categories($post->ID);
    if ($cat) {
      $args = array(
        'category__in' => array($cat[0]),
        'post__not_in' => array($post->ID),
        'showposts' => 5
        );
      query_posts($args);

      echo "<hr><h3>相关文章</h3>";

      echo "<ul class='post-bottom inline'>";
      while (have_posts()) {
        the_post();
        echo "<li><a href='";
          the_permalink();
        echo "' rel='bookmark' title='";
          the_title_attribute();
        echo "'>";
          the_title();
        echo "</a></li>";
      }
      echo "</ul>";
      wp_reset_query();
    }
  }
endif;


/*** 评论列表的显示 ***/
if ( ! function_exists( 'callback_comment' ) ) :
function callback_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
    // 用不同于其它评论的方式显示 trackbacks 。
  ?>
  <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)' ), '<span class="edit-link">', '</span>' ); ?>
    </p>
  <?php
    break;
    default :
    // 开始正常的评论
    global $post;
   ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="media comment">
      <div class="pull-left">
        <?php // 显示评论作者头像 
          echo get_avatar( $comment, 64 ); 
        ?>
      </div>
      <?php // 未审核的评论显示一行提示文字
        if ( '0' == $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation">
          <?php _e( 'Your comment is awaiting moderation.' ); ?>
        </p>
      <?php endif; ?>
      <div class="media-body">
        <h4 class="media-heading">
          <?php // 显示评论作者名称
              printf( '%1$s %2$s',
              get_comment_author_link(),
              // 如果当前文章的作者也是这个评论的作者，那么会出现一个标签提示。
              ( $comment->user_id === $post->post_author ) ? '<span class="label label-info"> ' . __( '作者' ) . '</span>' : ''
            );
          ?>
          <small>
            <?php // 显示评论的发布时间
                printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                esc_url( get_comment_link( $comment->comment_ID ) ),
                get_comment_time( 'c' ),
                // 翻译: 1: 日期, 2: 时间
                sprintf( __( '%1$s %2$s' ), get_comment_date(), get_comment_time() )
              );
            ?>
          </small>
        </h4>
        <?php // 显示评论内容
          comment_text(); 
        ?>
        <?php // 显示评论的编辑链接 
          edit_comment_link( __( 'Edit' ), '<p class="edit-link">', '</p>' ); 
        ?>
        <div class="reply">
          <?php // 显示评论的回复链接 
            comment_reply_link( array_merge( $args, array( 
              'reply_text' =>  __( 'Reply' ), 
              'after'      =>  ' <span>&crarr;</span>', 
              'depth'      =>  $depth, 
              'max_depth'  =>  $args['max_depth'] ) ) ); 
          ?>
        </div>
      </div>
    </article>
  <?php
    break;
  endswitch; // end comment_type check
}
endif;
/*** Widgets ***/
if(!function_exists('widgets_init')):
  function widgets_init() {
    register_sidebar( array(
      'name'          => __( '边栏1' ),
      'id'            => 'sidebar-1',
      'description'   => __( 'Appears in the footer section of the site.' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
      'name'          => __( '边栏2' ),
      'id'            => 'sidebar-2',
      'description'   => __( 'Appears on posts and pages in the sidebar.' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );
  }
add_action( 'widgets_init', 'widgets_init' );
endif;