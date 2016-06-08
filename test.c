#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main( void )
{
  int x, y, i, j, cnt;
  char *query, *cookies, tmp[1000];

  query = getenv("QUERY_STRING");
  if (sscanf(query, "x=%d&y=%d", &x, &y) != 2)
  	x = y = 1;

  cookies = getenv("HTTP_COOKIE");
  if (cookies == NULL)
     cnt = 0;
  else
  {
     char *s = strstr(cookies, "cnt=");
     if (s == NULL)
       cnt = 0;
     else
       sscanf(s, "cnt=%d%s", &cnt, tmp);
  }

  if (x < 0)
  	x *= -1;
  if (y < 0)
  	y *= -1;

  printf("Set-Cookie: cnt=%d; host=mail.ru.;\n", ++cnt);
  printf("Content-Type: text/html;\n\n");

  printf("<html><head><title>Test</title><meta charset='utf-8' /></head><body>"
  	"<form><label for='x'>X:</label> <input type='text' name='x' value='%d' /> "
  	"<label for='x'>Y:</label> <input type='text' name='y' value='%d' /> "
  	"<input type='submit' value='Считать' /></form><table>", x, y);

  for (j = 1; j <= y; j++)
  {
  	printf("<tr>");
  	for (i = 1; i <= x; i++)
  	  printf("<td>%d</td>", i * j);
  	printf("</tr>");
  }

  printf("</table>%s</body></html>",cookies);
  
  return 1;
}
