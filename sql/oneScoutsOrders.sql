SELECT 
	concat(firstname,' ',lastname) as 'Scout',
    scoutid
FROM scout
WHERE scoutid = 24;

SELECT
	o.oid as 'Order#',
    concat(c.firstname,' ', c.lastname) as 'Customer',
	qty as 'QTY',
    fname as 'Flower',
	fvariety as 'Variety',
    fcontainer as 'Container'
FROM flower f
INNER JOIN ordflowers of
  ON f.flowerid = of.flowerid
INNER JOIN orders o 
  ON of.orderid = o.oid
INNER JOIN customer c
  ON o.cid = c.custid
INNER JOIN scout s
  ON o.sid = s.scoutid AND
	    s.scoutid = 24
GROUP BY
	Customer, Container, Flower,Variety
ORDER BY
	o.oid, Container DESC, Flower, Variety
