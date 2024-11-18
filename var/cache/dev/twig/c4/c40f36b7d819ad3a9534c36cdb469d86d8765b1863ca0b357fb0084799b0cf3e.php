<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @WebProfiler/Profiler/cancel.html.twig */
class __TwigTemplate_e1c09c1e610095315718ff1f3bf8273709c88b5ffc3dd8cac0512a28cbb2ea07 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'toolbar' => [$this, 'block_toolbar'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@WebProfiler/Profiler/cancel.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@WebProfiler/Profiler/cancel.html.twig"));

        // line 1
        yield from $this->unwrap()->yieldBlock('toolbar', $context, $blocks);
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        return; yield '';
    }

    public function block_toolbar($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "toolbar"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "toolbar"));

        // line 2
        yield "    ";
        $context["icon"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 3
            yield "        ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "@WebProfiler/Icon/symfony.svg");
            yield "

        <span class=\"sf-toolbar-value sf-toolbar-ajax-request-counter\">
            Loading&hellip;
        </span>
    ";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 9
        yield "
    ";
        // line 10
        $context["text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 11
            yield "        <div class=\"sf-toolbar-info-piece\">
            <b>Loading the web debug toolbar&hellip;</b>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            Attempt #<span id=\"sfLoadCounter-";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 15, $this->source); })()), "html", null, true);
            yield "\"></span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>
                <button class=\"sf-cancel-button\" type=\"button\" id=\"sfLoadCancel-";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 19, $this->source); })()), "html", null, true);
            yield "\" title=\"Cancel loading\">Cancel</button>
            </b>
        </div>
    ";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 23
        yield "
    ";
        // line 24
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@WebProfiler/Profiler/toolbar_item.html.twig", ["link" => (isset($context["profiler_url"]) || array_key_exists("profiler_url", $context) ? $context["profiler_url"] : (function () { throw new RuntimeError('Variable "profiler_url" does not exist.', 24, $this->source); })())]);
        yield "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@WebProfiler/Profiler/cancel.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  108 => 24,  105 => 23,  97 => 19,  90 => 15,  84 => 11,  82 => 10,  79 => 9,  68 => 3,  65 => 2,  45 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% block toolbar %}
    {% set icon %}
        {{ include('@WebProfiler/Icon/symfony.svg') }}

        <span class=\"sf-toolbar-value sf-toolbar-ajax-request-counter\">
            Loading&hellip;
        </span>
    {% endset %}

    {% set text %}
        <div class=\"sf-toolbar-info-piece\">
            <b>Loading the web debug toolbar&hellip;</b>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            Attempt #<span id=\"sfLoadCounter-{{ token }}\"></span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>
                <button class=\"sf-cancel-button\" type=\"button\" id=\"sfLoadCancel-{{ token }}\" title=\"Cancel loading\">Cancel</button>
            </b>
        </div>
    {% endset %}

    {{ include('@WebProfiler/Profiler/toolbar_item.html.twig', { link: profiler_url }) }}
{% endblock %}
", "@WebProfiler/Profiler/cancel.html.twig", "C:\\Users\\puype\\Desktop\\PHP\\my_project\\vendor\\symfony\\web-profiler-bundle\\Resources\\views\\Profiler\\cancel.html.twig");
    }
}
