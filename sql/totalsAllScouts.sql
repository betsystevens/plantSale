/*
/*
/*
/* */
SELECT
	sum(qty * retail) as 'Total',
	scoutid as 'ID',
	concat(firstname, ' ', lastname) as 'Scout',
	count(distinct oid) as 'Orders'
FROM orders o
INNER JOIN ordflowers of
  ON of.orderid = o.oid
INNER JOIN flower f 
  ON f.flowerid = of.flowerid
INNER JOIN price p
  ON p.container = f.fcontainer
INNER JOIN scout s
  ON s.scoutid = o.sid
GROUP BY
	Scout
ORDER BY
	Total desc;
