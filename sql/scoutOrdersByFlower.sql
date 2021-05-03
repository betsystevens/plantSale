set @id = 21;

select concat(scout.lastname, '  ',  scout.firstname ) as Scout,
	scoutid
from
	scout
where
	scoutid = @id;

select
	sum(qty) as 'Qty',
	fcontainer as 'Container', 
	fname as 'Flower',
	fvariety as 'Variety'
from 
	flower, orders, ordflowers, scout, price
where 
	sid = scoutid and sid = @id and
	oid = orderid and
	ordflowers.flowerid = flower.flowerid and
	price.container = fcontainer
            
group by 
	scoutid, container,flower,variety
order by  
	scout.lastname, 
	container, 
	Flower, Qty desc;

