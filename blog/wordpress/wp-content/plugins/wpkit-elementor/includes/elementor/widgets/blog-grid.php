<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WKE_Blog_Grid_Widget extends Widget_Base {

    public function get_name() {
        return 'blog-grid';
    }

    public function get_title() {
        return apply_filters( 'wke_blog_grid_title', esc_html__( 'Blog Grid', 'wpkit-elementor' ) );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return array( 'wpkit-common-widget' );
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_blog_grid_post',
            [
                'label' => esc_html__( 'Post Setting', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__( 'Number of Posts', 'wpkit-elementor' ),
                'default' => '6',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Order By', 'wpkit-elementor' ),
                'default' => 'date',
                'options' => array(
                    'date' => esc_html__( 'Date', 'wpkit-elementor' ),
                    'rand' => esc_html__( 'Random', 'wpkit-elementor' ),
                )
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => array(
                    'desc' => esc_html__('Desc','wpkit-elementor' ),
                    'asc' => esc_html__('Asc','wpkit-elementor' ),
                )
            ]
        );


        $this->add_control(

            'category',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Categories', 'wpkit-elementor' ),
                'default' => '',
                'description' => esc_html__( 'Specific the categories for the posts. Multiple category should be separated by English comma.', 'wpkit-elementor' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_blog_grid_general',
            [
                'label' => esc_html__( 'General Setting', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'wpkit-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'columns-3',
                'options' => array(
                    'columns-2' => esc_html__( '2 Columns', 'wpkit-elementor' ),
                    'columns-3' => esc_html__( '3 Columns', 'wpkit-elementor' ),
                    'columns-4' => esc_html__( '4 Columns','wpkit-elementor' )
                )
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => esc_html__( 'Enable Pagination', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '0',
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => '1',
            ]
        );

        $this->add_control(
            'post_meta_date',
            [
                'label' => esc_html__( 'Show Post Date', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 1,
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 1,
            ]
        );

        $this->add_control(
            'post_meta_category',
            [
                'label' => esc_html__( 'Show Post Category', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 1,
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 1,
            ]
        );

        $this->add_control(
            'post_meta_author',
            [
                'label' => esc_html__( 'Show Post Author', 'wpkit-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 1,
                'label_on' => esc_html__( 'Yes', 'wpkit-elementor' ),
                'label_off' => esc_html__( 'No', 'wpkit-elementor' ),
                'return_value' => 1,
            ]
        );

        $this->add_control(
            'extra_class',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Extra Class', 'wpkit-elementor' ),
                'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpkit-elementor' ),
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_blog_grid_title_style',
            [
                'label' => esc_html__( 'Title', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Title Color', 'wpkit-elementor' ),
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .wke-post-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'type' => Controls_Manager::COLOR,
                'default' => '#eee',
                'label' => esc_html__( 'Title Hover Color', 'wpkit-elementor' ),
                'selectors' => [
                    '{{WRAPPER}} .wke-post-title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'wpkit-elementor' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-post-title a',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_blog_grid_category_style',
            [
                'label' => esc_html__( 'Category', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'category_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Text Color', 'wpkit-elementor' ),
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .category-link, {{WRAPPER}} .category-link a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => esc_html__( 'Text Typography', 'wpkit-elementor' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-post-excerpt',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_blog_grid_meta_style',
            [
                'label' => esc_html__( 'Meta Text', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Text Color', 'wpkit-elementor' ),
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .wke-post .meta, {{WRAPPER}} .wke-post .meta a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__( 'Text Typography', 'wpkit-elementor' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .wke-post .meta, {{WRAPPER}} .wke-post .meta a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_blog_grid_overlay_style',
            [
                'label' => esc_html__( 'Overlay', 'wpkit-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => esc_html__( 'Overlay Color', 'wpkit-elementor' ),
                'default' => 'rgba(0,0,0,0.3)',
                'selectors' => [
                    '{{WRAPPER}} .wke-grid-blog .wke-post-thumbnail .overlay' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        WKE_Extend_Elementor::widget_template( self::get_name(),$this->get_settings() );
    }

    protected function _content_template() {

    }

}
