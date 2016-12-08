# Wordpress-Cases

```
$case_args = array(
    'numberposts' => 4,
    'offset' => 0,
    'category' => 0,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'meta_key' => '',
    'meta_value' =>'',
    'post_type' => 'cases',
    'post_status' => 'publish',
    'suppress_filters' => true
);

$recent_cases = wp_get_recent_posts( $case_args, ARRAY_A );
foreach ($recent_cases as $case) {
    $url = get_permalink($case['ID']);
    $cases[] = array("ID"=>$case['ID'], "thumbnail" => get_the_post_thumbnail_url($case['ID'], 'large'), "title"=>$case['post_title'], "description"=>$case['post_content'], "url"=>$url);
}
