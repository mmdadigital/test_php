<?php

/* property_listing.html */
class __TwigTemplate_a9595eea851775edca2f52507c1d7b386bb012bbc9c89af66f9636763af8939e extends Twig_Template
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
<html>
  <head>
      <title>Castro de tipo de imóvel</title>
      <script src=\"";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["jquery"]) ? $context["jquery"] : null), "html", null, true);
        echo "\"></script>
      <script src=\"";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["app_js"]) ? $context["app_js"] : null), "html", null, true);
        echo "\"></script>
  </head>
  <body>
    ";
        // line 9
        echo (isset($context["property_list"]) ? $context["property_list"] : null);
        echo "
    <a href=\"/\">Home</a>
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "property_listing.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 9,  29 => 6,  25 => 5,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*   <head>*/
/*       <title>Castro de tipo de imóvel</title>*/
/*       <script src="{{jquery}}"></script>*/
/*       <script src="{{app_js}}"></script>*/
/*   </head>*/
/*   <body>*/
/*     {{property_list|raw}}*/
/*     <a href="/">Home</a>*/
/*   </body>*/
/* </html>*/
/* */
