<?php

/* user.html */
class __TwigTemplate_9fc19d0bfe009db7008bb4baaf23587ba48de4644ca7647f5d8e1be1f1405bae extends Twig_Template
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
      <title>Castro de contato</title>
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
    <div id=\"user-form\">
      <form>
        <input class=\"user-name\" type=\"text\" placeholder=\"Nome\"/>
        <input class=\"user-phones\" type=\"text\" placeholder=\"Telefones\"/>
        <input class=\"user-emails\" type=\"text\" placeholder=\"E-mails\"/>
        <p>Adicione multiplos telefones e e-mails colocando \";\" entre os valores</p>
        <a href=\"/\">Home</a>
        <a href=\"/\" class=\"user-submit\">Salvar
        Contato</a>
      </form>
    </div>
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "user.html";
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
/*       <title>Castro de contato</title>*/
/*       <script src="{{jquery}}"></script>*/
/*       <script src="{{app_js}}"></script>*/
/*   </head>*/
/*   <body>*/
/*     <div id="user-form">*/
/*       <form>*/
/*         <input class="user-name" type="text" placeholder="Nome"/>*/
/*         <input class="user-phones" type="text" placeholder="Telefones"/>*/
/*         <input class="user-emails" type="text" placeholder="E-mails"/>*/
/*         <p>Adicione multiplos telefones e e-mails colocando ";" entre os valores</p>*/
/*         <a href="/">Home</a>*/
/*         <a href="/" class="user-submit">Salvar*/
/*         Contato</a>*/
/*       </form>*/
/*     </div>*/
/*   </body>*/
/* </html>*/
/* */
