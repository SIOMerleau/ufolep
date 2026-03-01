<div class="footer-container">
    <footer class="page-footer font-small blue pt-4">

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-2 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Liens utiles</h5>

                    <!--                    <div class="horizontal-sep"></div>-->
                    <hr class="">
                    <ul class="list-unstyled">
                        <li>
                            <a href="mailto:ufolep-usep-1@laligue17.org" class="link footer-text">Contact</a>
                        </li>
                        <li>
                            <a href="{{route('info.rgpd')}}" class="link footer-text">Politique de confidentialité</a>
                        </li>
                        
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 mb-md-0 mb-3">

                    <!-- Links -->
                        <h5 class="text-uppercase">Plan du site</h5>
                        <hr>
                        <ul class="list-unstyled">
                        <li>
                            <a href="{{route('championnats.listeActuelle')}}"
                               class="link footer-text">Championnats</a>
                        </li>
                        <li>
                            <a href="{{route('joueur.listeGenerale')}}" class="link footer-text">Classement des joueurs</a>
                        </li>

                        <li>
                            @php /* Si l'utilisateur est connecté */ @endphp
                            @if(Auth::check())
                                <a href="{{route('admin.listeChampionnat')}}" class="link footer-text">Mon espace</a>  
                            @php /* Sinon */ @endphp
                            @else 
                                <a href="{{route('auth.login')}}" class="link footer-text">Connexion</a>
                            @endif
                        </li>
                    </ul>

                    </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-md-8 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase" style="text-align:right;">UFOLEP 17 </h5>

                    <p class="footer-text text-right">Résidence Club La Fayette, Avenue de Bourgogne 17401 La Rochelle
                        (CEDEX
                        01)
                        <br>05 46 41 73 13
                        <br>ufolep-usep@laligue17.org
                        <br><br>
                        Réalisé avec <i class="heart-shape"></i> par le BTS SIO de Rochefort.
                        <br>
                        <span style="color: rgba(255, 255, 255, 0.5)">
                            <span style="color:rgba(255, 79, 79, 0.75)">Hugo</span>,
                            <span style="color:rgba(210, 255, 47, 0.75)">Simon</span>,
                            <span style="color:rgba(75, 177, 121, 0.75)">Gabriel</span>,
                            <span style="color:rgba(75, 123, 255, 0.75)">Raphaël</span> et
                            <span style="color:rgba(255, 107, 223, 0.75)">Léo</span>
                    </p>
                    <br>
                </div>
            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->
    </footer>
</div>