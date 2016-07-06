<?php

/* home.html */
class __TwigTemplate_0f7993b33ec28703f462e5c9cc22592763765e7b3326bd237fe1973e88411932 extends Twig_Template
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
      <title>MMDA Test 1 and 2</title>
      <script src=\"";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["jquery"]) ? $context["jquery"] : null), "html", null, true);
        echo "\"></script>
      <script src=\"";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["app_js"]) ? $context["app_js"] : null), "html", null, true);
        echo "\"></script>
      <script>
        var App = {'menuSettings': ";
        // line 8
        echo twig_jsonencode_filter((isset($context["menu_settings"]) ? $context["menu_settings"] : null));
        echo "};
      </script>
  </head>
  <body>
    <div id=\"app-menu\">";
        // line 12
        echo (isset($context["menu"]) ? $context["menu"] : null);
        echo "</div>
    <p>
      <a href=\"/adicionar-contato\">Adicionar Contato</a>
      <a href=\"/adicionar-imovel\">Adicionar Imóvel</a>
      <a href=\"/adicionar-tipo-imovel\">Adicionar Tipo de Imóvel</a>
      <a href=\"/imoveis\">Listagem de imóveis</a>
    </p>
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "home.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 12,  34 => 8,  29 => 6,  25 => 5,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*   <head>*/
/*       <title>MMDA Test 1 and 2</title>*/
/*       <script src="{{jquery}}"></script>*/
/*       <script src="{{app_js}}"></script>*/
/*       <script>*/
/*         var App = {'menuSettings': {{menu_settings|json_encode|raw}}};*/
/*       </script>*/
/*   </head>*/
/*   <body>*/
/*     <div id="app-menu">{{menu|raw}}</div>*/
/*     <p>*/
/*       <a href="/adicionar-contato">Adicionar Contato</a>*/
/*       <a href="/adicionar-imovel">Adicionar Imóvel</a>*/
/*       <a href="/adicionar-tipo-imovel">Adicionar Tipo de Imóvel</a>*/
/*       <a href="/imoveis">Listagem de imóveis</a>*/
/*     </p>*/
/*   </body>*/
/* </html>*/
/* */
