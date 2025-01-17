    <?php
    include '../../../header_e.php';
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../assets/CSS/style.css">
        <title>Jeu Cryptographique - Grille de Slam</title>
        <style>
            body {
                background-color: black;
                color: #00ff00;
                font-family: Arial, sans-serif;
                text-align: center;
                margin: 0;
                padding: 0;
            }
            .grid-container {
                display: grid;
                grid-template-columns: repeat(20, 20px); /* 20 colonnes de 20px chacune */
                grid-template-rows: repeat(29, 20px); /* 29 lignes de 20px chacune */
                grid-gap: 2px; /* Espacement entre les cases */
                margin: 20px auto; /* Centrer la grille */
                width: calc(20 * 20px + 19 * 2px); /* Largeur totale avec les gaps */
                height: calc(29 * 20px + 28 * 2px); /* Hauteur totale avec les gaps */
            }
            .cell {
                width: 20px; /* Largeur fixe de 20px */
                height: 20px; /* Hauteur fixe de 20px */
                border: 1px solid #00ff00;
                text-align: center;
                font-size: 12px; /* Police adaptée à la taille des cellules */
                line-height: 20px; /* Centrer le texte verticalement */
                background-color: black;
                color: #00ff00;
                text-transform: uppercase;
                visibility: hidden; /* Lettres cachées au départ */
            }
            .cell.red {
                background-color: #8db8ae;
                color: #fff;
                visibility: visible; /* Les cases rouges sont visibles */
            }
            .cell.reallyred {
                background-color: red;
                color: #fff;
                visibility: visible; /* Les cases rouges sont visibles */
            }

            .clue {
                margin: 20px;
                color: #00ff00;
            }
            input[type="text"] {
                background-color: black;
                color: #00ff00;
                border: 1px solid #00ff00;
                padding: 5px;
                margin: 5px;
                text-transform: uppercase;
                width: 200px;
            }
            button {
                background-color: #00ff00;
                color: black;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                margin-top: 10px;
            }
            button:hover {
                background-color: #006600;
            }
            #sudoku-section {
        background-color: black;
        color: #00ff00;
        font-family: Arial, sans-serif;
        padding: 20px;
        text-align: center;
        margin-top: 20px;
    }

    #sudoku-section input[type="text"] {
        background-color: black;
        color: #00ff00;
        border: 1px solid #00ff00;
        padding: 5px;
        margin: 5px;
    }

    #sudoku-section button {
        background-color: #00ff00;
        color: black;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        margin-top: 10px;
    }

    #sudoku-section button:hover {
        background-color: #006600;
    }

        </style>
    </head>
    <body>
        <h1>Grille Cryptographique de Slam</h1>
        <p>Résolvez les énigmes et remplissez la grille pour découvrir le mot secret !</p>

        <div>
            <button id="btn-grille" onclick="toggleVisibility('grille-section', 'btn-grille')">Cacher la grille</button>
        </div>

        <!-- Grille -->
        <div id="grille-section">
        <h2>La Grille</h2>
        <div class="grid-container">
            <!-- Ligne 1 -->
            <div class="cell" id="cell-0"></div>
            <div class="cell" id="cell-1"></div>
            <div class="cell" id="cell-2"></div>
            <div class="cell" id="cell-3"></div>
            <div class="cell" id="cell-4"></div>
            <div class="cell" id="cell-5"></div>
            <div class="cell" id="cell-6"></div>
            <div class="cell" id="cell-7"></div>
            <div class="cell" id="cell-8"></div>
            <div class="cell" id="cell-9"></div>
            <div class="cell reallyred" id="cell-10" data-letter="V"></div>
            <div class="cell" id="cell-11"></div>
            <div class="cell" id="cell-12"></div>
            <div class="cell" id="cell-13"></div>
            <div class="cell" id="cell-14"></div>
            <div class="cell" id="cell-15"></div>
            <div class="cell" id="cell-16"></div>
            <div class="cell" id="cell-17"></div>
            <div class="cell" id="cell-18"></div>
            <div class="cell" id="cell-19"></div>

            <!-- Ligne 2 -->
            <div class="cell" id="cell-20"></div>
            <div class="cell" id="cell-21"></div>
            <div class="cell" id="cell-22"></div>
            <div class="cell" id="cell-23"></div>
            <div class="cell" id="cell-24"></div>
            <div class="cell" id="cell-25"></div>
            <div class="cell" id="cell-26"></div>
            <div class="cell" id="cell-27"></div>
            <div class="cell" id="cell-28"></div>
            <div class="cell" id="cell-29"></div>
            <div class="cell red" id="cell-30" data-letter="E">E</div> <!-- E -->
            <div class="cell" id="cell-31"></div>
            <div class="cell" id="cell-32"></div>
            <div class="cell" id="cell-33"></div>
            <div class="cell" id="cell-34"></div>
            <div class="cell" id="cell-35"></div>
            <div class="cell" id="cell-36"></div>
            <div class="cell" id="cell-37"></div>
            <div class="cell" id="cell-38"></div>
            <div class="cell" id="cell-39"></div>

            <!-- Ligne 3 -->
            <div class="cell" id="cell-40"></div>
            <div class="cell" id="cell-41"></div>
            <div class="cell" id="cell-42"></div>
            <div class="cell" id="cell-43"></div>
            <div class="cell" id="cell-44"></div>
            <div class="cell" id="cell-45"></div>
            <div class="cell" id="cell-46"></div>
            <div class="cell" id="cell-47"></div>
            <div class="cell" id="cell-48"></div>
            <div class="cell reallyred" id="cell-49" data-letter="O"></div> <!-- O -->
            <div class="cell red" id="cell-50" data-letter="C"></div> <!-- C -->
            <div class="cell red" id="cell-51" data-letter="T"></div> <!-- T -->
            <div class="cell red" id="cell-52" data-letter="E"></div> <!-- E -->
            <div class="cell red" id="cell-53" data-letter="T"></div> <!-- T -->
            <div class="cell" id="cell-54"></div>
            <div class="cell" id="cell-55"></div>
            <div class="cell" id="cell-56"></div>
            <div class="cell" id="cell-57"></div>
            <div class="cell" id="cell-58"></div>
            <div class="cell" id="cell-59"></div>

            <!-- Ligne 4 -->
            <div class="cell" id="cell-60"></div>
            <div class="cell" id="cell-61"></div>
            <div class="cell" id="cell-62"></div>
            <div class="cell" id="cell-63"></div>
            <div class="cell" id="cell-64"></div>
            <div class="cell" id="cell-65"></div>
            <div class="cell" id="cell-66"></div>
            <div class="cell" id="cell-67"></div>
            <div class="cell" id="cell-68"></div>
            <div class="cell" id="cell-69"></div>
            <div class="cell red" id="cell-70" data-letter="T"></div> <!-- T -->
            <div class="cell" id="cell-71"></div>
            <div class="cell" id="cell-72"></div>
            <div class="cell" id="cell-73"></div>
            <div class="cell" id="cell-74"></div>
            <div class="cell" id="cell-75"></div>
            <div class="cell" id="cell-76"></div>
            <div class="cell" id="cell-77"></div>
            <div class="cell" id="cell-78"></div>
            <div class="cell" id="cell-79"></div>

            <!-- Ligne 5 -->
            <div class="cell" id="cell-80"></div>
            <div class="cell" id="cell-81"></div>
            <div class="cell" id="cell-82"></div>
            <div class="cell" id="cell-83"></div>
            <div class="cell" id="cell-84"></div>
            <div class="cell" id="cell-85"></div>
            <div class="cell reallyred" id="cell-86" data-letter="U"></div> <!-- U -->
            <div class="cell red" id="cell-87" data-letter="N"></div> <!-- N -->
            <div class="cell red" id="cell-88" data-letter="I"></div> <!-- I -->
            <div class="cell red" id="cell-89" data-letter="T"></div> <!-- T -->
            <div class="cell red" id="cell-90" data-letter="E">E</div> <!-- E -->
            <div class="cell reallyred" id="cell-91" data-letter="S"></div> <!-- S -->
            <div class="cell" id="cell-92"></div>
            <div class="cell" id="cell-93"></div>
            <div class="cell" id="cell-94"></div>
            <div class="cell" id="cell-95"></div>
            <div class="cell" id="cell-96"></div>
            <div class="cell" id="cell-97"></div>
            <div class="cell" id="cell-98"></div>
            <div class="cell" id="cell-99"></div>



            <!-- Ligne 10 -->
            <div class="cell" id="cell-100"></div>
            <div class="cell" id="cell-101"></div>
            <div class="cell" id="cell-102"></div>
            <div class="cell" id="cell-103"></div>
            <div class="cell" id="cell-104"></div>
            <div class="cell" id="cell-105"></div>
            <div class="cell" id="cell-106"></div>
            <div class="cell" id="cell-107"></div>
            <div class="cell" id="cell-108"></div>
            <div class="cell" id="cell-109"></div>
            <div class="cell red" id="cell-110" data-letter="U"></div>
            <div class="cell" id="cell-111"></div>
            <div class="cell" id="cell-112"></div>
            <div class="cell" id="cell-113"></div>
            <div class="cell" id="cell-114"></div>
            <div class="cell" id="cell-115"></div>
            <div class="cell" id="cell-116"></div>
            <div class="cell" id="cell-117"></div>
            <div class="cell" id="cell-118"></div>
            <div class="cell" id="cell-119"></div>

            <!-- Ligne 2 -->
            <div class="cell" id="cell-120"></div>
            <div class="cell" id="cell-121"></div>
            <div class="cell" id="cell-122"></div>
            <div class="cell" id="cell-123"></div>
            <div class="cell" id="cell-124"></div>
            <div class="cell" id="cell-125"></div>
            <div class="cell" id="cell-126"></div>
            <div class="cell" id="cell-127"></div>
            <div class="cell" id="cell-128"></div>
            <div class="cell" id="cell-129"></div>
            <div class="cell red" id="cell-130" data-letter="R"></div>
            <div class="cell reallyred" id="cell-131" data-letter="E"></div>
            <div class="cell red" id="cell-132" data-letter="A">A</div>
            <div class="cell red" id="cell-133" data-letter="C">C</div>
            <div class="cell reallyred" id="cell-134" data-letter="T"></div>
            <div class="cell red" id="cell-135" data-letter="I"></div>
            <div class="cell red" id="cell-136" data-letter="O"></div>
            <div class="cell red" id="cell-137" data-letter="N"></div>
            <div class="cell" id="cell-138"></div>
            <div class="cell" id="cell-139"></div>

            <!-- Ligne 3 -->
            <div class="cell" id="cell-140"></div>
            <div class="cell" id="cell-141"></div>
            <div class="cell" id="cell-142"></div>
            <div class="cell" id="cell-143"></div>
            <div class="cell" id="cell-144"></div>
            <div class="cell" id="cell-145"></div>
            <div class="cell" id="cell-146"></div>
            <div class="cell" id="cell-147"></div>
            <div class="cell" id="cell-148"></div>
            <div class="cell" id="cell-149"></div>
            <div class="cell" id="cell-150"></div>
            <div class="cell" id="cell-151"></div>
            <div class="cell" id="cell-152"></div>
            <div class="cell" id="cell-153"></div>
            <div class="cell red" id="cell-154" data-letter="H"></div>
            <div class="cell" id="cell-155"></div>
            <div class="cell" id="cell-156"></div>
            <div class="cell" id="cell-157"></div>
            <div class="cell" id="cell-158"></div>
            <div class="cell" id="cell-159"></div>

            <!-- Ligne 4 -->
            <div class="cell" id="cell-160"></div>
            <div class="cell" id="cell-161"></div>
            <div class="cell" id="cell-162"></div>
            <div class="cell" id="cell-163"></div>
            <div class="cell" id="cell-164"></div>
            <div class="cell" id="cell-165"></div>
            <div class="cell" id="cell-166"></div>
            <div class="cell reallyred" id="cell-167" data-letter="D"></div> <!-- T -->
            <div class="cell red" id="cell-168" data-letter="E"></div> <!-- T -->
            <div class="cell red" id="cell-169" data-letter="C"></div> <!-- T -->
            <div class="cell red" id="cell-170" data-letter="O"></div> <!-- T -->
            <div class="cell red" id="cell-171" data-letter="D"></div> <!-- T -->
            <div class="cell red" id="cell-172" data-letter="A"></div> <!-- T -->
            <div class="cell red" id="cell-173" data-letter="G">G</div> <!-- T -->
            <div class="cell red" id="cell-174" data-letter="E"></div> <!-- T -->
            <div class="cell" id="cell-175"></div>
            <div class="cell" id="cell-176"></div>
            <div class="cell" id="cell-177"></div>
            <div class="cell" id="cell-178"></div>
            <div class="cell" id="cell-179"></div>

            <!-- Ligne 5 -->
            <div class="cell" id="cell-180"></div>
            <div class="cell" id="cell-181"></div>
            <div class="cell" id="cell-182"></div>
            <div class="cell" id="cell-183"></div>
            <div class="cell" id="cell-184"></div>
            <div class="cell" id="cell-185"></div>
            <div class="cell" id="cell-186"></div>
            <div class="cell" id="cell-187"></div>
            <div class="cell" id="cell-188"></div>
            <div class="cell" id="cell-189"></div>
            <div class="cell" id="cell-190"></div>
            <div class="cell" id="cell-191"></div>
            <div class="cell" id="cell-192"></div>
            <div class="cell" id="cell-193"></div>
            <div class="cell red" id="cell-194" data-letter="O"></div> <!-- T -->
            <div class="cell" id="cell-195"></div>
            <div class="cell" id="cell-196"></div>
            <div class="cell" id="cell-197"></div>
            <div class="cell" id="cell-198"></div>
            <div class="cell" id="cell-199"></div>


            <!-- Ligne 10 -->
            <div class="cell" id="cell-200"></div>
            <div class="cell" id="cell-201"></div>
            <div class="cell" id="cell-202"></div>
            <div class="cell" id="cell-203"></div>
            <div class="cell" id="cell-204"></div>
            <div class="cell" id="cell-205"></div>
            <div class="cell" id="cell-206"></div>
            <div class="cell" id="cell-207"></div>
            <div class="cell" id="cell-208"></div>
            <div class="cell" id="cell-209"></div>
            <div class="cell" id="cell-210"></div>
            <div class="cell" id="cell-211"></div>
            <div class="cell" id="cell-212"></div>
            <div class="cell" id="cell-213"></div>
            <div class="cell red" id="cell-214" data-letter="R"></div>
            <div class="cell" id="cell-215"></div>
            <div class="cell" id="cell-216"></div>
            <div class="cell" id="cell-217"></div>
            <div class="cell" id="cell-218"></div>
            <div class="cell" id="cell-219"></div>

            <!-- Ligne 2 -->
            <div class="cell" id="cell-220"></div>
            <div class="cell" id="cell-221"></div>
            <div class="cell" id="cell-222"></div>
            <div class="cell" id="cell-223"></div>
            <div class="cell" id="cell-224"></div>
            <div class="cell red" id="cell-225" data-letter="A">A</div>
            <div class="cell red" id="cell-226" data-letter="L"></div>
            <div class="cell red" id="cell-227" data-letter="G"></div>
            <div class="cell red" id="cell-228" data-letter="O"></div>
            <div class="cell red" id="cell-229" data-letter="R"></div>
            <div class="cell reallyred" id="cell-230" data-letter="I"></div>
            <div class="cell red" id="cell-231" data-letter="T"></div>
            <div class="cell red" id="cell-232" data-letter="H"></div>
            <div class="cell red" id="cell-233" data-letter="M"></div>
            <div class="cell red" id="cell-234" data-letter="E"></div>
            <div class="cell" id="cell-235"></div>
            <div class="cell" id="cell-236"></div>
            <div class="cell" id="cell-237"></div>
            <div class="cell" id="cell-238"></div>
            <div class="cell" id="cell-239"></div>

            <!-- Ligne 3 -->
            <div class="cell" id="cell-240"></div>
            <div class="cell" id="cell-241"></div>
            <div class="cell" id="cell-242"></div>
            <div class="cell" id="cell-243"></div>
            <div class="cell" id="cell-244"></div>
            <div class="cell" id="cell-245"></div>
            <div class="cell" id="cell-246"></div>
            <div class="cell" id="cell-247"></div>
            <div class="cell" id="cell-248"></div>
            <div class="cell" id="cell-249"></div>
            <div class="cell" id="cell-250"></div>
            <div class="cell" id="cell-251"></div>
            <div class="cell" id="cell-252"></div>
            <div class="cell" id="cell-253"></div>
            <div class="cell red" id="cell-254" data-letter="M">M</div>
            <div class="cell" id="cell-255"></div>
            <div class="cell" id="cell-256"></div>
            <div class="cell" id="cell-257"></div>
            <div class="cell" id="cell-258"></div>
            <div class="cell" id="cell-259"></div>

            <!-- Ligne 4 -->
            <div class="cell" id="cell-260"></div>
            <div class="cell" id="cell-261"></div>
            <div class="cell" id="cell-262"></div>
            <div class="cell" id="cell-263"></div>
            <div class="cell" id="cell-264"></div>
            <div class="cell" id="cell-265"></div>
            <div class="cell reallyred" id="cell-266" data-letter="G"></div> <!-- T -->
            <div class="cell red" id="cell-267" data-letter="R"></div> <!-- T -->
            <div class="cell red" id="cell-268" data-letter="A"></div> <!-- T -->
            <div class="cell red" id="cell-269" data-letter="P"></div> <!-- T -->
            <div class="cell red" id="cell-270" data-letter="H">H</div> <!-- T -->
            <div class="cell red" id="cell-271" data-letter="I">I</div> <!-- T -->
            <div class="cell red" id="cell-272" data-letter="Q"></div> <!-- T -->
            <div class="cell red" id="cell-273" data-letter="U"></div> <!-- T -->
            <div class="cell red" id="cell-274" data-letter="E"></div> <!-- T -->
            <div class="cell" id="cell-275"></div>
            <div class="cell" id="cell-276"></div>
            <div class="cell" id="cell-277"></div>
            <div class="cell" id="cell-278"></div>
            <div class="cell" id="cell-279"></div>

            <!-- Ligne 5 -->
            <div class="cell" id="cell-280"></div>
            <div class="cell" id="cell-281"></div>
            <div class="cell" id="cell-282"></div>
            <div class="cell" id="cell-283"></div>
            <div class="cell" id="cell-284"></div>
            <div class="cell" id="cell-285"></div>
            <div class="cell" id="cell-286"></div>
            <div class="cell" id="cell-287"></div>
            <div class="cell red" id="cell-288" data-letter="F">F</div> <!-- T -->
            <div class="cell" id="cell-289"></div>
            <div class="cell" id="cell-290"></div>
            <div class="cell" id="cell-291"></div>
            <div class="cell" id="cell-292"></div>
            <div class="cell" id="cell-293"></div>
            <div class="cell" id="cell-294"></div>
            <div class="cell" id="cell-295"></div>
            <div class="cell" id="cell-296"></div>
            <div class="cell" id="cell-297"></div>
            <div class="cell" id="cell-298"></div>
            <div class="cell" id="cell-299"></div>


            <div class="cell" id="cell-300"></div>
            <div class="cell" id="cell-301"></div>
            <div class="cell" id="cell-302"></div>
            <div class="cell" id="cell-303"></div>
            <div class="cell" id="cell-304"></div>
            <div class="cell" id="cell-305"></div>
            <div class="cell" id="cell-306"></div>
            <div class="cell" id="cell-307"></div>
            <div class="cell red" id="cell-308" data-letter="F"></div> <!-- T -->
            <div class="cell" id="cell-309"></div>
            <div class="cell" id="cell-310"></div>
            <div class="cell" id="cell-311"></div>
            <div class="cell" id="cell-312"></div>
            <div class="cell" id="cell-313"></div>
            <div class="cell" id="cell-314"></div>
            <div class="cell" id="cell-315"></div>
            <div class="cell" id="cell-316"></div>
            <div class="cell" id="cell-317"></div>
            <div class="cell" id="cell-318"></div>
            <div class="cell" id="cell-319"></div>

            <!-- Ligne 2 -->
            <div class="cell" id="cell-320"></div>
            <div class="cell" id="cell-321"></div>
            <div class="cell" id="cell-322"></div>
            <div class="cell" id="cell-323"></div>
            <div class="cell" id="cell-324"></div>
            <div class="cell" id="cell-325"></div>
            <div class="cell" id="cell-326"></div>
            <div class="cell" id="cell-327"></div>
            <div class="cell red" id="cell-328" data-letter="I"></div>
            <div class="cell" id="cell-329"></div>
            <div class="cell" id="cell-330"></div>
            <div class="cell" id="cell-331"></div>
            <div class="cell" id="cell-332"></div>
            <div class="cell" id="cell-333"></div>
            <div class="cell" id="cell-334"></div>
            <div class="cell" id="cell-335"></div>
            <div class="cell" id="cell-336"></div>
            <div class="cell" id="cell-337"></div>
            <div class="cell" id="cell-338"></div>
            <div class="cell" id="cell-339"></div>

            <!-- Ligne 3 -->
            <div class="cell" id="cell-340"></div>
            <div class="cell" id="cell-341"></div>
            <div class="cell" id="cell-342"></div>
            <div class="cell" id="cell-343"></div>
            <div class="cell" id="cell-344"></div>
            <div class="cell" id="cell-345"></div>
            <div class="cell" id="cell-346"></div>
            <div class="cell" id="cell-347"></div>
            <div class="cell reallyred" id="cell-348" data-letter="N"></div>
            <div class="cell" id="cell-349"></div>
            <div class="cell" id="cell-350"></div>
            <div class="cell" id="cell-351"></div>
            <div class="cell" id="cell-352"></div>
            <div class="cell" id="cell-353"></div>
            <div class="cell" id="cell-354"></div>
            <div class="cell" id="cell-355"></div>
            <div class="cell" id="cell-356"></div>
            <div class="cell" id="cell-357"></div>
            <div class="cell" id="cell-358"></div>
            <div class="cell" id="cell-359"></div>

            <!-- Ligne 4 -->
            <div class="cell" id="cell-360"></div>
            <div class="cell reallyred" id="cell-361" data-letter="C"></div> <!-- T -->
            <div class="cell red" id="cell-362" data-letter="R"></div> <!-- T -->
            <div class="cell red" id="cell-363" data-letter="Y"></div> <!-- T -->
            <div class="cell red" id="cell-364" data-letter="P">P</div> <!-- T -->
            <div class="cell red" id="cell-365" data-letter="T"></div> <!-- T -->
            <div class="cell red" id="cell-366" data-letter="A"></div> <!-- T -->
            <div class="cell red" id="cell-367" data-letter="G"></div> <!-- T -->
            <div class="cell red" id="cell-368" data-letter="E"></div> <!-- T -->
            <div class="cell" id="cell-369"></div>
            <div class="cell" id="cell-370"></div>
            <div class="cell" id="cell-371"></div>
            <div class="cell" id="cell-372"></div>
            <div class="cell" id="cell-373"></div>
            <div class="cell" id="cell-374"></div>
            <div class="cell" id="cell-375"></div>
            <div class="cell" id="cell-376"></div>
            <div class="cell" id="cell-377"></div>
            <div class="cell" id="cell-378"></div>
            <div class="cell" id="cell-379"></div>

            <!-- Ligne 5 -->
            <div class="cell" id="cell-380"></div>
            <div class="cell" id="cell-381"></div>
            <div class="cell" id="cell-382"></div>
            <div class="cell" id="cell-383"></div>
            <div class="cell" id="cell-384"></div>
            <div class="cell" id="cell-385"></div>
            <div class="cell reallyred" id="cell-386" data-letter="F"></div> <!-- T -->
            <div class="cell" id="cell-387"></div>
            <div class="cell" id="cell-388"></div>
            <div class="cell" id="cell-389"></div>
            <div class="cell" id="cell-390"></div>
            <div class="cell" id="cell-391"></div>
            <div class="cell" id="cell-392"></div>
            <div class="cell" id="cell-393"></div>
            <div class="cell" id="cell-394"></div>
            <div class="cell" id="cell-395"></div>
            <div class="cell" id="cell-396"></div>
            <div class="cell" id="cell-397"></div>
            <div class="cell" id="cell-398"></div>
            <div class="cell" id="cell-399"></div>




            <div class="cell" id="cell-400"></div>
            <div class="cell" id="cell-401"></div>
            <div class="cell" id="cell-402"></div>
            <div class="cell" id="cell-403"></div>
            <div class="cell" id="cell-404"></div>
            <div class="cell" id="cell-405"></div>
            <div class="cell red" id="cell-406" data-letter="F"></div> <!-- T -->
            <div class="cell" id="cell-407"></div>
            <div class="cell" id="cell-408"></div>
            <div class="cell" id="cell-409"></div>
            <div class="cell" id="cell-410"></div>
            <div class="cell" id="cell-411"></div>
            <div class="cell" id="cell-412"></div>
            <div class="cell" id="cell-413"></div>
            <div class="cell" id="cell-414"></div>
            <div class="cell" id="cell-415"></div>
            <div class="cell" id="cell-416"></div>
            <div class="cell" id="cell-417"></div>
            <div class="cell" id="cell-418"></div>
            <div class="cell" id="cell-419"></div>


            <div class="cell" id="cell-420"></div>
            <div class="cell" id="cell-421"></div>
            <div class="cell" id="cell-422"></div>
            <div class="cell" id="cell-423"></div>
            <div class="cell" id="cell-424"></div>
            <div class="cell" id="cell-425"></div>
            <div class="cell red" id="cell-426" data-letter="I"></div> <!-- T -->
            <div class="cell" id="cell-427"></div>
            <div class="cell" id="cell-428"></div>
            <div class="cell" id="cell-429"></div>
            <div class="cell" id="cell-430"></div>
            <div class="cell" id="cell-431"></div>
            <div class="cell" id="cell-432"></div>
            <div class="cell" id="cell-433"></div>
            <div class="cell" id="cell-434"></div>
            <div class="cell" id="cell-435"></div>
            <div class="cell" id="cell-436"></div>
            <div class="cell" id="cell-437"></div>
            <div class="cell" id="cell-438"></div>
            <div class="cell" id="cell-439"></div>
        
            <div class="cell" id="cell-440"></div>
            <div class="cell" id="cell-441"></div>
            <div class="cell" id="cell-442"></div>
            <div class="cell" id="cell-443"></div>
            <div class="cell" id="cell-444"></div>
            <div class="cell" id="cell-445"></div>
            <div class="cell red" id="cell-446" data-letter="R"></div> <!-- T -->
            <div class="cell" id="cell-447"></div>
            <div class="cell" id="cell-448"></div>
            <div class="cell" id="cell-449"></div>
            <div class="cell" id="cell-450"></div>
            <div class="cell" id="cell-451"></div>
            <div class="cell" id="cell-452"></div>
            <div class="cell" id="cell-453"></div>
            <div class="cell" id="cell-454"></div>
            <div class="cell" id="cell-455"></div>
            <div class="cell" id="cell-456"></div>
            <div class="cell" id="cell-457"></div>
            <div class="cell" id="cell-458"></div>
            <div class="cell" id="cell-459"></div>

            <div class="cell" id="cell-460"></div>
            <div class="cell" id="cell-461"></div>
            <div class="cell" id="cell-462"></div>
            <div class="cell" id="cell-463"></div>
            <div class="cell" id="cell-464"></div>
            <div class="cell" id="cell-465"></div>
            <div class="cell red" id="cell-466" data-letter="M"></div> <!-- T -->
            <div class="cell" id="cell-467"></div>
            <div class="cell" id="cell-468"></div>
            <div class="cell" id="cell-469"></div>
            <div class="cell" id="cell-470"></div>
            <div class="cell" id="cell-471"></div>
            <div class="cell" id="cell-472"></div>
            <div class="cell" id="cell-473"></div>
            <div class="cell" id="cell-474"></div>
            <div class="cell" id="cell-475"></div>
            <div class="cell" id="cell-476"></div>
            <div class="cell" id="cell-477"></div>
            <div class="cell" id="cell-478"></div>
            <div class="cell" id="cell-479"></div>

            <div class="cell" id="cell-480"></div>
            <div class="cell" id="cell-481"></div>
            <div class="cell" id="cell-482"></div>
            <div class="cell" id="cell-483"></div>
            <div class="cell" id="cell-484"></div>
            <div class="cell" id="cell-485"></div>
            <div class="cell reallyred" id="cell-486" data-letter="A"></div> <!-- T -->
            <div class="cell" id="cell-487"></div>
            <div class="cell" id="cell-488"></div>
            <div class="cell" id="cell-489"></div>
            <div class="cell" id="cell-490"></div>
            <div class="cell" id="cell-491"></div>
            <div class="cell" id="cell-492"></div>
            <div class="cell" id="cell-493"></div>
            <div class="cell" id="cell-494"></div>
            <div class="cell" id="cell-495"></div>
            <div class="cell" id="cell-496"></div>
            <div class="cell" id="cell-497"></div>
            <div class="cell" id="cell-498"></div>
            <div class="cell" id="cell-499"></div>

            <div class="cell" id="cell-500"></div>
            <div class="cell" id="cell-501"></div>
            <div class="cell" id="cell-502"></div>
            <div class="cell" id="cell-503"></div>
            <div class="cell" id="cell-504"></div>
            <div class="cell" id="cell-505"></div>
            <div class="cell red" id="cell-506" data-letter="T"></div> <!-- T -->
            <div class="cell" id="cell-507"></div>
            <div class="cell" id="cell-508"></div>
            <div class="cell" id="cell-509"></div>
            <div class="cell" id="cell-510"></div>
            <div class="cell" id="cell-511"></div>
            <div class="cell" id="cell-512"></div>
            <div class="cell" id="cell-513"></div>
            <div class="cell" id="cell-514"></div>
            <div class="cell" id="cell-515"></div>
            <div class="cell" id="cell-516"></div>
            <div class="cell" id="cell-517"></div>
            <div class="cell" id="cell-518"></div>
            <div class="cell" id="cell-519"></div>

            <div class="cell" id="cell-520"></div>
            <div class="cell" id="cell-521"></div>
            <div class="cell" id="cell-522"></div>
            <div class="cell" id="cell-523"></div>
            <div class="cell" id="cell-524"></div>
            <div class="cell" id="cell-525"></div>
            <div class="cell red" id="cell-526" data-letter="I">I</div> <!-- T -->
            <div class="cell" id="cell-527"></div>
            <div class="cell" id="cell-528"></div>
            <div class="cell" id="cell-529"></div>
            <div class="cell" id="cell-530"></div>
            <div class="cell" id="cell-531"></div>
            <div class="cell" id="cell-532"></div>
            <div class="cell" id="cell-533"></div>
            <div class="cell" id="cell-534"></div>
            <div class="cell" id="cell-535"></div>
            <div class="cell" id="cell-536"></div>
            <div class="cell" id="cell-537"></div>
            <div class="cell" id="cell-538"></div>
            <div class="cell" id="cell-539"></div>

            <div class="cell" id="cell-540"></div>
            <div class="cell" id="cell-541"></div>
            <div class="cell" id="cell-542"></div>
            <div class="cell" id="cell-543"></div>
            <div class="cell" id="cell-544"></div>
            <div class="cell" id="cell-545"></div>
            <div class="cell red" id="cell-546" data-letter="O">O</div> <!-- T -->
            <div class="cell" id="cell-547"></div>
            <div class="cell" id="cell-548"></div>
            <div class="cell" id="cell-549"></div>
            <div class="cell" id="cell-550"></div>
            <div class="cell" id="cell-551"></div>
            <div class="cell" id="cell-552"></div>
            <div class="cell" id="cell-553"></div>
            <div class="cell" id="cell-554"></div>
            <div class="cell" id="cell-555"></div>
            <div class="cell" id="cell-556"></div>
            <div class="cell" id="cell-557"></div>
            <div class="cell" id="cell-558"></div>
            <div class="cell" id="cell-559"></div>

            <div class="cell" id="cell-560"></div>
            <div class="cell" id="cell-561"></div>
            <div class="cell" id="cell-562"></div>
            <div class="cell" id="cell-563"></div>
            <div class="cell" id="cell-564"></div>
            <div class="cell" id="cell-565"></div>
            <div class="cell red" id="cell-566" data-letter="N"></div> <!-- T -->
            <div class="cell" id="cell-567"></div>
            <div class="cell" id="cell-568"></div>
            <div class="cell" id="cell-569"></div>
            <div class="cell" id="cell-570"></div>
            <div class="cell" id="cell-571"></div>
            <div class="cell" id="cell-572"></div>
            <div class="cell" id="cell-573"></div>
            <div class="cell" id="cell-574"></div>
            <div class="cell" id="cell-575"></div>
            <div class="cell" id="cell-576"></div>
            <div class="cell" id="cell-577"></div>
            <div class="cell" id="cell-578"></div>
            <div class="cell" id="cell-579"></div>
        </div>
        </div>
        <div>
            <button id="btn-enigmes" onclick="toggleVisibility('enigmes-section', 'btn-enigmes')">Cacher les énigmes</button>
        </div>
        <!-- Énigmes -->
        <div id="enigmes-section">
        <h2>Les Énigmes</h2>
        <div class="clue">
            <p>1. C'est une flèche mathématique qui a une direction, une longueur, et qui sert souvent à représenter des forces ou des déplacements dans un espace. (7 lettres)</p>
            <input type="text" id="word-0" placeholder="Entrez le mot" onkeyup="checkWord(0)">
            <button onclick="showAnswer(0)">Afficher la réponse</button>
        </div>
        <div class="clue">
            <p>2. Cet ensemble de 8 bits est la base pour stocker et transmettre des informations dans un ordinateur. (5 lettres)</p>
            <input type="text" id="word-1" placeholder="Entrez le mot" onkeyup="checkWord(1)">
            <button onclick="showAnswer(1)">Afficher la réponse</button>
        </div>
        <div class="clue">
            <p>3. Dans le système métrique, ce sont elles qui permettent de mesurer des grandeurs comme le temps, la masse, ou la longueur. (6 lettres)</p>
            <input type="text" id="word-2" placeholder="Entrez le mot" onkeyup="checkWord(2)">
            <button onclick="showAnswer(2)">Afficher la réponse</button>
        </div>
        <div class="clue">
            <p>4. Dans une expérience chimique ou une interaction physique, c'est ce qui se produit en réponse à une action ou un stimulus. (8 lettres)</p>
            <input type="text" id="word-3" placeholder="Entrez le mot" onkeyup="checkWord(3)">
            <button onclick="showAnswer(3)">Afficher la réponse</button>
        </div>
        <div class="clue">
            <p>5. C'est une affirmation mathématique qu'on prouve rigoureusement, comme celui de Pythagore. (8 lettres)</p>
            <input type="text" id="word-4" placeholder="Entrez le mot" onkeyup="checkWord(4)">
            <button onclick="showAnswer(4)">Afficher la réponse</button>
        </div>
        <div class="clue">
            <p>6. C'est l'art de comprendre ou de traduire un message codé pour en révéler le contenu original. (8 lettres)</p>
            <input type="text" id="word-5" placeholder="Entrez le mot" onkeyup="checkWord(5)">
            <button onclick="showAnswer(5)">Afficher la réponse</button>
        </div>
        <div class="clue">
            <p>7. C'est une suite d'étapes logiques utilisée par un ordinateur ou un humain pour résoudre un problème. (10 lettres)</p>
            <input type="text" id="word-6" placeholder="Entrez le mot" onkeyup="checkWord(6)">
            <button onclick="showAnswer(6)">Afficher la réponse</button>
        </div>
        <div class="clue">
            <p>8. C'est une représentation visuelle de données, souvent utilisée pour comprendre des relations ou des tendances. (9 lettres)</p>
            <input type="text" id="word-7" placeholder="Entrez le mot" onkeyup="checkWord(7)">
            <button onclick="showAnswer(7)">Afficher la réponse</button>
        </div>
        <div class="clue">
            <p>9. Cette fonction mathématique est une droite, mais elle peut ne pas passer par l'origine. Elle est définie par une pente et une constante. (6 lettres)</p>
            <input type="text" id="word-8" placeholder="Entrez le mot" onkeyup="checkWord(8)">
            <button onclick="showAnswer(8)">Afficher la réponse</button>
        </div>
        <div class="clue">
            <p>10. C'est l'art de transformer un message pour qu'il soit illisible sans une clé secrète. (8 lettres)</p>
            <input type="text" id="word-9" placeholder="Entrez le mot" onkeyup="checkWord(9)">
            <button onclick="showAnswer(9)">Afficher la réponse</button>
        </div>
        <div class="clue">
            <p>11. C'est une déclaration ou une proposition que l'on tient pour vraie, souvent utilisée en logique ou en philosophie. (11 lettres)</p>
            <input type="text" id="word-10" placeholder="Entrez le mot" onkeyup="checkWord(10)">
            <button onclick="showAnswer(10)">Afficher la réponse</button>
        </div>
        </div>
        <div>
        <button id="btn-sudoku" onclick="toggleVisibility('sudoku-section', 'btn-sudoku')">Cacher le Cryptex Sudoku</button>
    </div>
    <div id="sudoku-section">
        <h1>Cryptex Sudoku</h1>
        <p>Décryptez le message en remplaçant les caractères !</p>

        <!-- Message crypté -->
        <div id="message">
            ✶☼☯★ ♠♣♠★ ♥♦◊⌘♠★ ♥♠ ☢☼⌘⚡♦☪⌘☢♠
        </div>

        <!-- Clé de décryptage -->
        <div id="key-section">
            <h3>Clé de Décryptage</h3>
            <p>Entrez une lettre pour chaque symbole :</p>
            <div>✶ = <input type="text" id="key-✶" maxlength="1" oninput="updateMessage()"></div>
            <div>☼ = <input type="text" id="key-☼" maxlength="1" oninput="updateMessage()"></div>
            <div>☯ = <input type="text" id="key-☯" maxlength="1" oninput="updateMessage()"></div>
            <div>★ = <input type="text" id="key-★" maxlength="1" oninput="updateMessage()"></div>
            <div>♠ = <input type="text" id="key-♠" maxlength="1" oninput="updateMessage()"></div>
            <div>♣ = <input type="text" id="key-♣" maxlength="1" oninput="updateMessage()"></div>
            <div>♥ = <input type="text" id="key-♥" maxlength="1" oninput="updateMessage()"></div>
            <div>♦ = <input type="text" id="key-♦" maxlength="1" oninput="updateMessage()"></div>
            <div>◊ = <input type="text" id="key-◊" maxlength="1" oninput="updateMessage()"></div>
            <div>⌘ = <input type="text" id="key-⌘" maxlength="1" oninput="updateMessage()"></div>
            <div>☢ = <input type="text" id="key-☢" maxlength="1" oninput="updateMessage()"></div>
            <div>⚡ = <input type="text" id="key-⚡" maxlength="1" oninput="updateMessage()"></div>
            <div>☪ = <input type="text" id="key-☪" maxlength="1" oninput="updateMessage()"></div>
        </div>
    </div>



        <script>
            // Liste des mots à deviner
            const words = ["VECTEUR", "OCTET", "UNITES", "REACTION", "THEOREME", "DECODAGE","ALGORITHME","GRAPHIQUE","AFFINE","CRYPTAGE","AFFIRMATION"];
            const answers = [
                { word: "VECTEUR", positions: [10,30,50,70,90,110,130] },
                { word: "OCTET", positions: [49,50,51,52,53] },
                { word: "UNITES", positions: [86,87,88,89,90,91] },
                { word: "REACTION", positions: [130,131,132,133,134,135,136,137] },
                { word: "THEOREME", positions: [134,154,174,194,214,234,254,274] },
                { word: "DECODAGE", positions: [167,168,169,170,171,172,173,174] },
                { word: "ALGORITHME", positions: [225,226,227,228,229,230,231,232,233,234] },
                { word: "GRAPHIQUE", positions: [266,267,268,269,270,271,272,273,274] },
                { word: "AFFINE", positions: [268,288,308,328,348,368] },
                { word: "CRYPTAGE", positions: [361,362,363,364,365,366,367,368] },
                { word: "AFFIRMATION", positions: [366,386,406,426,446,466,486,506,526,546,566] }
            ];
            let correctAnswers = [false, false, false, false, false, false,false,false,false, false,false]; // Suivi des mots trouvés

            // Vérification des mots
            function checkWord(index) {
                const word = document.getElementById("word-" + index).value.toUpperCase();
                if (word === words[index]) {
                    correctAnswers[index] = true;
                    // Révéler les lettres une fois le mot trouvé
                    revealLetters(index);
                }
            }

            function showAnswer(index) {
                    correctAnswers[index] = true;
                    // Révéler les lettres une fois le mot trouvé
                    revealLetters(index);
            }

            // Révéler les lettres dans les cases rouges
            function revealLetters(index) {
        const word = answers[index].word; // Mot à révéler
        const positions = answers[index].positions; // Positions des lettres dans la grille

        // Parcourt chaque lettre du mot
        for (let i = 0; i < positions.length; i++) {
            const cell = document.getElementById("cell-" + positions[i]); // Case correspondante
            cell.textContent = word[i]; // Place la lettre dans la case
            cell.style.visibility = "visible"; // Rend la lettre visible
        }
    }

            function toggleVisibility(sectionId, buttonId) {
                const section = document.getElementById(sectionId);
                const button = document.getElementById(buttonId);

                if (section.style.display === "none") {
                    section.style.display = "block";
                    button.textContent = "Cacher";
                    button.style.backgroundColor = "#00ff00"; // Couleur pour section visible
                } else {
                    section.style.display = "none";
                    button.textContent = "Montrer";
                    button.style.backgroundColor = "#ff0000"; // Couleur pour section cachée
                }
            }

            function updateMessage() {
            const keys = {
                "✶": document.getElementById("key-✶").value || "✶",
                "☼": document.getElementById("key-☼").value || "☼",
                "☯": document.getElementById("key-☯").value || "☯",
                "★": document.getElementById("key-★").value || "★",
                "♠": document.getElementById("key-♠").value || "♠",
                "♣": document.getElementById("key-♣").value || "♣",
                "♥": document.getElementById("key-♥").value || "♥",
                "♦": document.getElementById("key-♦").value || "♦",
                "◊": document.getElementById("key-◊").value || "◊",
                "⌘": document.getElementById("key-⌘").value || "⌘",
                "☢": document.getElementById("key-☢").value || "☢",
                "⚡": document.getElementById("key-⚡").value || "⚡",
                "☪": document.getElementById("key-☪").value || "☪"
            };
            const originalMessage = "✶☼☯★ ♠♣♠★ ♥♦◊⌘♠★ ♥♠ ☢☼⌘⚡♦☪⌘☢♠";
            const decryptedText = {
                "✶": "V",
                "☼": "O",
                "☯": "U",
                "★": "S",
                "♠": "E",
                "♣": "T",
                "♥": "D",
                "♦": "I",
                "◊": "G",
                "⌘": "N",
                "☢": "C",
                "⚡": "F",
                "☪": "A"
            };

            let decryptedMessage = "";

            for (let char of originalMessage) {
                if (keys[char] && char in decryptedText && keys[char].toUpperCase() === decryptedText[char]) {
                    decryptedMessage += decryptedText[char];
                } else {
                    decryptedMessage += char;
                }
            }

            document.getElementById("message").textContent = decryptedMessage;
        }


            
        </script>

    </body>
    </html>