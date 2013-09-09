<?php

/**
 * Renderer for tool_classlist
 *
 * Class tool_classlist_renderer
 */
class tool_classlist_renderer extends plugin_renderer_base {

    /**
     * Render classlist
     *
     * @param tool_classlist_parser $parser
     *
     * @return string
     */
    public function render_tool_classlist_parser(tool_classlist_parser $parser) {
        $classes = $parser->get_classes();
        $html = $this->render_ng_table();
        return $html;
    }

    public function render_ng_table() {
        $html = html_writer::start_div('', array('ng-app' => 'tool_classlist_table', 'ng-controller' => 'classList'));
        $html .= html_writer::tag('strong', 'Page:{{page}}(Perpage:{{perPage}})');
        $tr = html_writer::tag(
            'tr',
            html_writer::tag('td', '{{class.class}}').
            html_writer::tag('td', '{{class.name}}').
            html_writer::tag('td', '{{class.file}}'),
            array('ng-repeat' => 'class in classes'));
        $html .= html_writer::tag('table', $tr , array('class' => 'flexible-wrap'));

        $html .= html_writer::start_div();
        $html .= html_writer::tag('button', 'Show Next' , array('ng-show' => 'hasNext()', 'ng-click' => 'showNext()'));
        $html .= html_writer::tag('button', 'Show Previous' , array('ng-show' => 'hasPrevious()', 'ng-click' => 'showPrevious()'));
        $html .= html_writer::end_div();

        // Per page.
        $html .= html_writer::start_div();
        $html .= html_writer::tag('span', get_string('perpage', 'tool_classlist'));
        $html .= html_writer::tag('button', 10, array('ng-click' => 'updatePerPage(10)'));
        $html .= html_writer::tag('button', 25, array('ng-click' => 'updatePerPage(25)'));
        $html .= html_writer::tag('button', 50, array('ng-click' => 'updatePerPage(50)'));
        $html .= html_writer::tag('button', 100, array('ng-click' => 'updatePerPage(100)'));
        $html .= html_writer::end_div();

        $html .= html_writer::end_div();
        return $html;
    }
}