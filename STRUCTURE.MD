Entrée ----> URL par exemple http://localhost:8383/Api_Mcp_test/tier/1 --> pour un get (id)



On va récupérer un tiers

Sortie JSON

Get by id -->

{"id":"13","username":"user","password":"$2y$10$Rd3QoBLaOZJJuWYvZcE6eOUpPGRaZB6Fjd3Wp6If6OKbFwHpr4r1i","age":"21","email":"email"}

Recherche en get par nom du client

http://localhost:8383/Api_Mcp_test/tier/id_winbooks/:id_winbooks

Sortie

{"id":"13","username":"id_winbooks","password":"$2y$10$Rd3QoBLaOZJJuWYvZcE6eOUpPGRaZB6Fjd3Wp6If6OKbFwHpr4r1i","age":"21","email":"email"}

Update

Entrée : http://localhost:8383/Api_Mcp_test/tier/update/1 --> update(id)

Sortie : tiers updated


Delete

http://localhost:8383/Api_Mcp_test/tier/delete/1 --> delete(id)


Entrée Sans paramètre
http://localhost:8383/Api_Mcp_test/tiers

Sortie

{"id":"14","username":"p1&"}
{"id":"12","username":"p1a"}
{"id":"13","username":"p1q"}
{"id":"11","username":"p1s"}
