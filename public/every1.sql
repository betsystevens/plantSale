SELECT 
			oid,
			c.lastname as custLast, c.firstname as custFirst,
			s.lastname as scoutLast, s.firstname as scoutFirst,
			paytype, amount
			qty, fname, fvariety, fcontainer
			
			FROM  orders INNER JOIN 
            customer c ON cid = c.custID INNER JOIN
            scout s ON sid = s.scoutid INNER JOIN
            ordflowers of ON of.orderid = oid INNER JOIN
            flower f ON f.flowerid = of.flowerid


			GROUP BY oid,fcontainer, fname, fvariety
			ORDER BY oid;
