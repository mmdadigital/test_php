<?php

/* property_type.html */
class __TwigTemplate_0fdebed16683385a2acd99639460ee82bd9e419b411836ab18cec6b12e4232d0 extends Twig_Template
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
    <div id=\"property-type-form\">
      <form>
        <input type=\"text\" placeholder=\"Tipo\"/>
        <a href=\"/\">Home</a>
        <a href=\"/\" class=\"property-type-submit\">Salvar
        Tipo de imóvel</a>
      </form>
    </div>
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "property_type.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 6,  25 => 5,  19 => 1,);
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
/*     <div id="property-type-form">*/
/*       <form>*/
/*         <input type="text" placeholder="Tipo"/>*/
/*         <a href="/">Home</a>*/
/*         <a href="/" class="property-type-submit">Salvar*/
/*         Tipo de imóvel</a>*/
/*       </form>*/
/*     </div>*/
/*   </body>*/
/* </html>*/
/* */
