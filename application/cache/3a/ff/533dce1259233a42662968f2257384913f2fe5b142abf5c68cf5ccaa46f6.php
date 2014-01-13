<?php

/* includes/header.php */
class __TwigTemplate_3aff533dce1259233a42662968f2257384913f2fe5b142abf5c68cf5ccaa46f6 extends Twig_Template
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
        echo "<div class=\"container\">
    <div class=\"row\">
        <nav class=\"navbar navbar-default\" role=\"navigation\">
            <div class=\"navbar-header\">
            <?php if(\$session['user_level'] == 99): ?>
            <a class=\"navbar-brand\" href=\"\">Bulletin Board</a>
            <?php endif; ?>
            </div>
            <ul class=\"nav navbar-nav navbar-right\">
                <li class=\"dropdown\">
                <a href=\"javascript: void(0);\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                <span class=\"glyphicon glyphicon-user\"></span>
                <?php echo \$session['user_name']; ?> <b class=\"caret\"></b></a>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        <li><a href=\"#\">Homepage</a></li>
                        <li><a href=\"\">Admin</a></li>
                        <li class=\"divider\"></li>
                        <li><a href=\"#\">Settings</a></li>
                        <li><a href=\"logout\">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "includes/header.php";
    }

    public function getDebugInfo()
    {
        return array (  37 => 16,  35 => 15,  19 => 1,);
    }
}
