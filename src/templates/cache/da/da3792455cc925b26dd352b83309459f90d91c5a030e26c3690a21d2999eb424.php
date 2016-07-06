<?php

/* property.html */
class __TwigTemplate_d902a17b03a20e0c5a8410fdc1b7424c8ac9e34b59ffc8ca0e85715130d6d752 extends Twig_Template
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
      <title>Castro de imóvel</title>
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
    <div id=\"property-form\">
      <form>
        <select class=\"property-type\">
          <option value=\"\" disabled selected>Tipo</option>
          ";
        // line 13
        echo (isset($context["property_types"]) ? $context["property_types"] : null);
        echo "
        </select>
        <select class=\"property-responsible\">
          <option value=\"\" disabled selected>Responsável</option>
          ";
        // line 17
        echo (isset($context["users"]) ? $context["users"] : null);
        echo "
        </select>
        <textarea class=\"property-photos\" placeholder=\"Fotos\"></textarea>
        <input class=\"property-street\" type=\"text\" placeholder=\"Rua\"/>
        <input class=\"property-number\" type=\"text\" placeholder=\"Número\"/>
        <input class=\"property-city\" type=\"text\" placeholder=\"Cidade\"/>
        <select class=\"property-state\">
          <option value=\"\" disabled selected>Estado</option>
          <option value=\"sp\">São Paulo</option>
          <option value=\"rj\">Rio de Janeiro</option>
        </select>
        <textarea class=\"property-description\" placeholder=\"Descrição\"></textarea>

        <p>Adicione multiplas fotos colocando \";\" entre os valores. Os valores deverão ser urls válidas para imagens.</p>
        <a href=\"/\">Home</a>
        <a href=\"/\" class=\"property-submit\">Salvar
        Imóvel</a>
      </form>
    </div>
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "property.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 17,  39 => 13,  29 => 6,  25 => 5,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*   <head>*/
/*       <title>Castro de imóvel</title>*/
/*       <script src="{{jquery}}"></script>*/
/*       <script src="{{app_js}}"></script>*/
/*   </head>*/
/*   <body>*/
/*     <div id="property-form">*/
/*       <form>*/
/*         <select class="property-type">*/
/*           <option value="" disabled selected>Tipo</option>*/
/*           {{property_types|raw}}*/
/*         </select>*/
/*         <select class="property-responsible">*/
/*           <option value="" disabled selected>Responsável</option>*/
/*           {{users|raw}}*/
/*         </select>*/
/*         <textarea class="property-photos" placeholder="Fotos"></textarea>*/
/*         <input class="property-street" type="text" placeholder="Rua"/>*/
/*         <input class="property-number" type="text" placeholder="Número"/>*/
/*         <input class="property-city" type="text" placeholder="Cidade"/>*/
/*         <select class="property-state">*/
/*           <option value="" disabled selected>Estado</option>*/
/*           <option value="sp">São Paulo</option>*/
/*           <option value="rj">Rio de Janeiro</option>*/
/*         </select>*/
/*         <textarea class="property-description" placeholder="Descrição"></textarea>*/
/* */
/*         <p>Adicione multiplas fotos colocando ";" entre os valores. Os valores deverão ser urls válidas para imagens.</p>*/
/*         <a href="/">Home</a>*/
/*         <a href="/" class="property-submit">Salvar*/
/*         Imóvel</a>*/
/*       </form>*/
/*     </div>*/
/*   </body>*/
/* </html>*/
/* */
