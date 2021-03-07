SELECT 
			oid,
			c.lastname as custLast, c.firstname as custFirst,
			s.lastname as scoutLast, s.firstname as scoutFirst,
			paytype, amount,
			qty, fname, fvariety, fcontainer
			
			FROM
			customer c, scout s, 
			orders, flower f, ordflowers of
			
			WHERE
			f.flowerid = of.flowerid AND
			of.orderid = oid AND
			c.custid = cid AND
			s.scoutid = sid

			GROUP BY oid,fcontainer, fname, fvariety
			ORDER BY oid;
