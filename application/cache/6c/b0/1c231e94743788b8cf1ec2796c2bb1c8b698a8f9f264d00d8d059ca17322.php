<?php

/* list.html.twig */
class __TwigTemplate_6cb01c231e94743788b8cf1ec2796c2bb1c8b698a8f9f264d00d8d059ca17322 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
\t<meta charset=\"utf-8\">
    <base href=\"";
        // line 5
        if (isset($context["base_url"])) { $_base_url_ = $context["base_url"]; } else { $_base_url_ = null; }
        echo twig_escape_filter($this->env, $_base_url_, "html", null, true);
        echo "\"/>
\t<title>Bulletin Board::";
        // line 6
        if (isset($context["title"])) { $_title_ = $context["title"]; } else { $_title_ = null; }
        echo twig_escape_filter($this->env, $_title_, "html", null, true);
        echo "</title>
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"../assets/bootstrap/css/bootstrap.min.css\"/>
    <style>
\t\t.announcement-img { position: relative }
\t\t.glyphicon-remove-circle { cursor:pointer; margin-left: 5px; top: 10px; position: absolute; }
\t</style>
</head>
<body>
<?php //require_once('includes/header.php'); ?>
";
        // line 15
        $this->env->loadTemplate("includes/header.php")->display($context);
        // line 16
        echo "<div class=\"container\">
\t<div class=\"row\">
    <?php foreach( \$announcement as \$ann ) { ?>
        <div class=\"panel panel-primary\">
            <div class=\"panel-heading\">
                <div class=\"pull-right\">
                    <i class=\"glyphicon glyphicon-calendar\"></i> <small><?php echo date('M d, Y', strtotime(\$ann->announcement_start)); ?> <strong>-</strong> <?php echo date('M d, Y', strtotime(\$ann->announcement_end)); ?></small>
                </div>
\t\t\t\t<h3 class=\"panel-title\"><i class=\"glyphicon glyphicon-bookmark\"></i> <?php echo \$ann->announcement_title; ?></h3>
            </div>
            <div class=\"panel-body\">
            \t<?php echo \$ann->announcement_description; ?>
            </div>
        </div>
        <div class=\"announcement-img\">
            <?php
                \$this->db->from('announcement_image');
                \$this->db->where('announcement_id', \$ann->announcement_id);
                \$images = \$this->db->get();
                foreach(\$images->result() as \$img) {
            ?>
            <i class=\"glyphicon glyphicon-remove-circle\" data-entry-id=\"<?php echo \$ann->announcement_id; ?>\"></i>
            <img src=\"assets/announcement/<?php echo \$img->image_name; ?>\" class=\"img-square\"  style=\"padding: 3px; border: 1px solid #CCC; background: #FFF; width: 150px; height: 150px\">
            <?php } ?>
        </div>
\t<?php } ?>
    </div>
</div>

<script type=\"text/javascript\" src=\"../assets/scripts/jquery.js\"></script>
<script type=\"text/javascript\" src=\"../assets/scripts/jquery-ui.js\"></script>
<script type=\"text/javascript\" src=\"../assets/bootstrap/js/bootstrap.min.js\"></script>
<script type=\"text/javascript\" src=\"../assets/scripts/mainpage.js\"></script></body>
</html>";
    }

    public function getTemplateName()
    {
        return "list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 16,  43 => 15,  30 => 6,  25 => 5,  19 => 1,);
    }
}
